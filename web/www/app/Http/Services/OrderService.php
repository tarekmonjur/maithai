<?php
/**
 * CategoryService
 * @author : Tarek Monjur
 * @email : tarekmonjur@gmail.com
 */

namespace App\Http\Services;

use App\Http\Controllers\Api\ProductController;
use App\Models\Order;
use App\Models\Table;
use App\Models\Offer;
use Carbon\Carbon;
use Illuminate\Http\Request;

trait OrderService
{
    use DataModelService;

    private $id = null;
    private $slug = null;
    private $columns = ['id','name', 'code'];
    private $sub_list = true;
    private $trans_prefix = 'sku.';
    private $trans_key = 'list';
    private $paginate = true;
    // columns config for table view
    private $columnsConfig = [
        'sl' => 100,
        'name' => 0,
        'code' => 0,
        'products_count' => 0,
        'location' => 0,
        'is_active' => 0,
        'created' => 0,
        'updated' => 0,
        'action' => 100,
    ];
    private $filtersConfig = [
        [
            'name' => 'name',
            'label' => '',
            'type' => 'text',
            'value' => null,
        ],
        [
            'name' => 'code',
            'label' => '',
            'type' => 'text',
            'value' => null,
        ],
        [
            'name' => 'is_active',
            'label' => 'status',
            'type' => 'select',
            'options' => [
                '1' => 'active',
                '0' => 'inactive'
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
            $dbModel = $dbModel->where('code', 'like', '%'.$filters['code'].'%');
        }
        if (isset($filters['is_active'])) {
            $dbModel = $dbModel->where('is_active', (int)$filters['is_active']);
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
        $sku = Sku::withCount('productStocks');

        if ($columns = $this->getColumns()) {
            $sku = $sku->select($columns);
        }

        if ($sub_list) {
            $relations = [];

            if (!empty($this->getId())) {
                array_push($relations, 'productStocks');
            }

            if ($this->authUser && $this->authUser->getTable() === 'users') {
                $relations = array_merge($relations, ['createdBy', 'updatedBy']);
            }

            if (!empty($relations)) {
                $sku = $sku->with($relations);
            }
        }

        if (!empty($this->getId())) {
            return $sku->find($this->getId());
        } else {
            $sku = $this->generateFilters($sku);

            if ($this->getPaginate()) {
                $sku = $sku->paginate(config('app.backend_per_page'));
            } else {
                $sku = $sku->get();
            }
            return $sku;
        }
    }

    protected function getDataModel()
    {
        $results = $this->getData()->toArray();
        if (empty($this->getId()) && $this->getPaginate()) {
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

    protected function getInvoiceNo($type = null)
    {
        if (empty($type)) {
            $type = 'O';
        } else if ($type === 'sales') {
            $type = 'S';
        } else if ($type === 'purchase') {
            $type = 'P';
        }
        return uniqid($type);
    }

    protected function getTableNo($id = null)
    {
        $table_no = null;
        if (!empty($id)) {
            $table_no = Table::find($id)->first('table_no');
        }
        return $table_no;
    }

    protected function getOfferByCode($coupon_code = null)
    {
        $offer = null;
        if (!empty($coupon_code)) {
            $to_date = Carbon::now()->format('YY-mm-dd');
            $offer = Offer::where('coupon_code', $coupon_code)
                ->where('offer_type', 'coupon')
                ->where('is_active', 1)
                ->whereDate('start_date', '<=', $to_date)
                ->whereDate('end_date', '>=', $to_date)
                ->first();
        }
        return $offer;
    }

    protected function makeItem($product_id)
    {
        if (!$product_id) {
            return [];
        }

        $productController = new ProductController();
        $request = new Request;
        $request->id_slug = $product_id;
//        dd($product->show($re)->getOriginalContent());
        $product = $productController->show($request)->getOriginalContent();

        $product_price = $product->special_price && $product->special_price > 0 ?
            $product->special_price : $product->regular_price;
        $vat_percent = $product->vat_percent;
        $vat_amount = $vat_percent && $vat_percent > 0 ?
            ($product_price * $vat_percent) / 100 : 0;
        $discount_percent = 0;
        $discount_amount = 0;

        if ($product->offer) {
            $discount_percent = $product->offer->discount_type === 'percent' ?
                $product->offer->discount : 0;
            $discount_amount = $product->offer->discount_type === 'amount' ?
                $product->offer->discount : 0;
            if ($discount_percent && !$discount_amount) {
                $discount_amount = ($product_price * $discount_percent) / 100;
            } else {
                $discount_percent = ($discount_amount * 100) / $product_price;
            }
        }

        $price = ($product_price + $vat_amount) - $discount_amount;
        $item = [
            'order_id' => null,
            'product_id' => $product->id,
            'offer_id' => $product->offer ? $product->offer->id : 0,
            'offer_name' => $product->offer ? $product->offer->name: null,
            'product_name' => $product->name,
            'product_code' => $product->name,
            'product_barcode' => $product->name,
            'product_unit' => $product->unit ? $product->unit->name : null,
            'product_variant' => '',
            'product_stock' => '',
            'product_price' => $product_price,
            'product_qty' => 1,
            'discount_percent' => $discount_percent,
            'discount_amount' => $discount_amount,
            'vat_percent' => $vat_percent,
            'vat_amount' => $vat_amount,
            'price' => $price,
            'sub_total' => $price,
            'item_lock' => false,
        ];

        return $item;
    }

    protected function makeOrder($request)
    {
        $order = [];
        if (empty($request->items)) {
            return $order;
        }

        $total_qty = 0;
        $total_sub_total_amount = 0;
        $total_sub_discount_percent = 0;
        $total_sub_discount_amount = 0;
        $total_sub_vat_percent = 0;
        $total_sub_vat_amount = 0;

        foreach($request->items as $item) {
            if ($request->order_source !== 'pos') {
                $item = $this->makeItem($item['product_id']);
            }
            if (!empty($item)) {
                $order['items'][] = $item;
                $total_qty = $total_qty + $item['product_qty'] ?? 0;
                $total_sub_total_amount = $total_sub_total_amount + $item['sub_total'] ?? 0;
                $total_sub_discount_percent = $total_sub_discount_percent + $item['discount_percent'] ?? 0;
                $total_sub_discount_amount = $total_sub_discount_amount + $item['discount_amount'] ?? 0;
                $total_sub_vat_percent = $total_sub_vat_percent + $item['vat_percent'] ?? 0;
                $total_sub_vat_amount = $total_sub_vat_amount + $item['vat_amount'] ?? 0;
            }
        }

        $order['invoice_no'] = $this->getInvoiceNo($request->type);
        $table_id = $request->table_id ?? 0;
        $table_no = $request->table_no ?? $this->getTableNo($request->table_id);
        $discount_percent = 0;
        $discount_amount = 0;
        $vat_percent = 0;
        $vat_amount = 0;
        $delivery_fee = 0;
        $processing_fee = 0;

        if ($request->order_source !== 'pos') {
            $offer = $this->getOfferByCode($request->coupon_code);
            if ($offer) {
                $offer_id = $offer->id ?? 0;
                $offer_name = $offer->name;
                $coupon_code = $offer->coupon_code;
                $discount_percent = 0;
                $discount_amount = 0;
            }
            $vat_percent = 0;
            $vat_amount = 0;
            $delivery_fee = 0;
            $processing_fee = 0;
            $total_discount_percent = $discount_percent + $total_sub_discount_percent;
            $total_discount_amount = $discount_amount + $total_sub_discount_amount;
            $total_vat_percent = $vat_percent + $total_sub_vat_percent;
            $total_vat_amount = $vat_amount + $total_sub_vat_amount;
            $total_payable_amount = ($total_sub_total_amount + $total_vat_amount + $delivery_fee + $processing_fee) - $total_discount_amount;
            $due_amount = $total_payable_amount;
            $total_pay_amount = 0;
        } else {
            $offer_id = $request->offer_id ?? 0;
            $offer_name = $request->offer_name;
            $coupon_code = $request->coupon_code;
            $discount_percent = $request->discount_percent;
            $discount_amount = $request->discount_amount;
            $vat_percent = $request->vat_percent;
            $vat_amount = $request->vat_amount;
            $delivery_fee = $request->delivery_fee;
            $processing_fee = $request->processing_fee;
            $total_discount_percent = $discount_percent + $total_sub_discount_percent;
            $total_discount_amount = $discount_amount + $total_sub_discount_amount;
            $total_vat_percent = $vat_percent + $total_sub_vat_percent;
            $total_vat_amount = $vat_amount + $total_sub_vat_amount;
            $total_payable_amount = ($total_sub_total_amount + $total_vat_amount + $delivery_fee + $processing_fee) - $total_discount_amount;
            $total_pay_amount = $request->received_amount;
            $due_amount = $total_payable_amount - $total_pay_amount;
        }

        $order_type = $request->type ?? 'sales';
        $order_source = $request->source ?? 'pos';
        $payment_type = $request->payment_type ?? 'none';
        $payment_status = $request->payment_type !== 'none' ?
            $due_amount <= 0 ? 'completed' : 'due'
            : 'pending';
        $order_status = $request->order_status ?? $payment_status === 'completed' ?? 'pending';

        return $order;
    }

}
