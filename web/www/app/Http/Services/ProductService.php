<?php
/**
 * ProductService
 * @author : Tarek Monjur
 * @email : tarekmonjur@gmail.com
 */

namespace App\Http\Services;

use App\Models\Product;
use App\Models\ProductStock;
use App\Models\ProductVariant;
use Carbon\Carbon;

trait ProductService
{
    use DataModelService;

    private $id = null;
    private $slug = null;
    private $columns = ['id','name','slug','code'];
    private $sub_list = true;
    private $trans_prefix = 'product.';
    private $trans_key = 'list';
    private $paginate = true;
    // columns config for table view
    private $columnsConfig = [
        'sl' => 100,
        'name' => 0,
        'code' => 0,
        'barcode' => 0,
        'sorting' => 0,
        'image' => 0,
        'unit' => 0,
        'category' => 0,
        'sub_category' => 0,
        'regular_price' => 0,
        'special_price' => 0,
        'vat_percent' => 0,
        'stock' => 0,
        'is_active' => 0,
        'is_package' => 0,
        'is_new' => 0,
        'action' => 100,
    ];
    private $filtersConfig = [
        [
            'name' => 'name',
            'label' => '',
            'type' => 'text',
            'value' => '',
        ],
        [
            'name' => 'code',
            'label' => '',
            'type' => 'text',
            'value' => '',
        ],
        [
            'name' => 'barcode',
            'label' => '',
            'type' => 'text',
            'value' => '',
        ],
        [
            'name' => 'category_id',
            'label' => '',
            'type' => 'select',
            'options' => null,
        ],
        [
            'name' => 'is_active',
            'label' => '',
            'type' => 'select',
            'options' => [
                '1' => 'active',
                '0' => 'inactive'
            ]
        ],
        [
            'name' => 'is_package',
            'label' => '',
            'type' => 'select',
            'options' => [
                '1' => 'yes',
                '0' => 'no'
            ]
        ],
        [
            'name' => 'from_date',
            'label' => '',
            'type' => 'date',
            'value' => '',
        ],
        [
            'name' => 'to_date',
            'label' => '',
            'type' => 'date',
            'value' => 0, // months
        ],
    ];
    private $filters = [];
    private $data = [];

    protected function setFiltersConfigData($key, $data) {
        $filters = $this->getFiltersConfig();
        if ($key) {
            foreach($filters as $index => $filter) {
                if ($filter['name'] === $key) {
                    $filters[$index]['options'] = $data;
                }
            }
        }
        $this->data['filters_config'] = $filters;
    }

    protected function generateFilters($dbModel)
    {
        $filters = $this->getFilters();
        if (empty($filters)) {
            return $dbModel;
        }
        if (isset($filters['name']) && !empty($filters['name'])) {
            $dbModel = $dbModel->where('name', 'like', '%'.$filters['name'].'%');
        }
        if (isset($filters['code']) && !empty($filters['code'])) {
            $dbModel = $dbModel->where('name', 'like', '%'.$filters['name'].'%');
        }
        if (isset($filters['barcode']) && !empty($filters['barcode'])) {
            $dbModel = $dbModel->where('barcode', 'like', '%'.$filters['barcode'].'%');
        }
        if (isset($filters['category_id'])) {
            $dbModel = $dbModel->where('category_id', (int)$filters['category_id']);
        }
        if (isset($filters['is_active'])) {
            $dbModel = $dbModel->where('is_active', (int)$filters['is_active']);
        }
        if (isset($filters['is_package'])) {
            $dbModel = $dbModel->where('is_package', (int)$filters['is_package']);
        }
        if (isset($filters['from_date']) && !empty($filters['from_date'])) {
            $from_date = Carbon::parse($filters['from_date'])->format('Y-m-d');
            $dbModel = $dbModel->whereDate('created_at', '>=', $from_date);
        }
        if (isset($filters['to_date']) && !empty($filters['to_date'])) {
            $to_date = Carbon::parse($filters['to_date'])->format('Y-m-d');
            $dbModel = $dbModel->whereDate('created_at', '<=', $to_date);
        }

        return $dbModel;
    }

    protected function getData()
    {
        $sub_list = $this->getSubList();
        $product = new Product;

        if ($columns = $this->getColumns()) {
            $product = $product->select($columns);
        }

        if ($sub_list) {
            $relations = ['category', 'subCategory', 'brand', 'unit'];
            if (!empty($this->getId()) || !empty($this->getSlug())) {
                array_push($relations, 'variants', 'stocks');
            }

            if ($this->authUser && $this->authUser->getTable() === 'users') {
                $relations = array_merge($relations, ['createdBy', 'updatedBy']);
            }

            if (!empty($relations)) {
                $product = $product->with($relations);
            }
        }

        if (!empty($this->getId())) {
            return $product->find($this->getId());
        }
        else if (!empty($this->getSlug())) {
            return $product->where('slug', $this->getSlug())
                ->get();
        } else {
            $product = $this->generateFilters($product);
            $product->orderBy('sort');
//            $product->orderByDesc('created_at');

            if ($this->getPaginate()) {
                $product = $product->paginate(config('app.backend_per_page'));
            } else {
                $product = $product->get();
            }
            return $product;
        }
    }

    protected function getDataModel()
    {
        $results = $this->getData()->toArray();
        if ((empty($this->getId()) && empty($this->getSlug())) &&
            $this->getPaginate()) {
            foreach($results as $key => $result) {
                if ($key !== 'data') {
                    $this->data['metadata'][$key] = $results[$key];
                }
            }
            $this->data['results'] = $results['data'];
        } else {
            $this->data['results'] = $results;
        }

        return $this->data;
    }

    protected function getProductCode($code = null)
    {
        if (!empty($code)) {
            return $code;
        }
        return uniqid('PC');
    }

    protected function getProductBarcode($code = null)
    {
        if (!empty($code)) {
            return $code;
        }
        return uniqid('BC');
    }

    protected function getSortNumber($sort = null)
    {
        if (!empty($sort) && is_numeric($sort)) {
            return intval($sort);
        }

        $result = Product::orderByDesc('sort')->first('sort');
        return $result ? $result->sort + 1 : 0;
    }

    protected function insertProductVariants($product_id, $variants = array())
    {
        if (empty($product_id) || empty($variants)) {
            return null;
        }

        $insertData = [];
        foreach($variants as $variant) {
            if (!empty($variant['id']) || empty($variant['variant_id'])) {
                continue;
            }

            $insertData[] = [
                'product_id' => $product_id,
                'variant_id' => $variant['variant_id'],
                'sub_variant_id' => !empty($variant['sub_variant_id']) ?? null,
                'additional_price' => !empty($variant['additional_price']) ?? null,
                'created_at' => Carbon::now(),
            ];
        }

        if (!empty($insertData)) {
            ProductVariant::insert($insertData);
        }
    }

    protected function updateProductVariants($product_id, $variants = array())
    {
        if (empty($product_id) || empty($variants)) {
            return null;
        }

        foreach($variants as $variant) {
            if (empty($variant['id']) || empty($variant['variant_id'])) {
                continue;
            }

            $productVariant = ProductVariant::find($variant['id']);
            if ($productVariant) {
                $productVariant->product_id = $product_id;
                $productVariant->variant_id = $variant['variant_id'];
                $productVariant->sub_variant_id = $variant['sub_variant_id'];
                $productVariant->additional_price = $variant['additional_price'];
                $productVariant->save();
            }
        }
    }

    protected function deleteProductVariants($product_id, $variants = array()) {
        if (empty($product_id) || empty($variants)) {
            return null;
        }

        foreach($variants as $variant) {
            if (empty($variant['id'])) {
                continue;
            }
            ProductVariant::where('id', $variant['id'])->delete();
        }
    }

    protected function insertProductStocks($product_id, $stocks = array())
    {
        if (empty($product_id) || empty($stocks)) {
            return null;
        }

        $insertData = [];
        foreach($stocks as $stock) {
            if (!empty($stock['id']) || empty($stock['sku_id'])) {
                continue;
            }

            $insertData[] = [
                'product_id' => $product_id,
                'sku_id' => $stock['sku_id'],
                'stock' => !empty($stock['stock']) ?? null,
                'created_at' => Carbon::now(),
            ];
        }

        if (!empty($insertData)) {
            ProductStock::insert($insertData);
        }
    }

    protected function updateProductStocks($product_id, $stocks = array())
    {
        if (empty($product_id) || empty($stocks)) {
            return null;
        }

        foreach($stocks as $stock) {
            if (empty($stock['id']) || empty($stock['sku_id'])) {
                continue;
            }

            $productStock = ProductStock::find($stock['id']);
            if ($productStock) {
                $productStock->product_id = $product_id;
                $productStock->sku_id = $stock['sku_id'];
                $productStock->stock = $stock['stock'];
                $productStock->save();
            }
        }
    }

    protected function deleteProductStocks($product_id, $stocks = array())
    {
        if (empty($product_id) || empty($stocks)) {
            return null;
        }

        foreach($stocks as $stock) {
            if (empty($stock['id'])) {
                continue;
            }
            ProductStock::where('id', $stock['id'])->delete();
        }
    }

}
