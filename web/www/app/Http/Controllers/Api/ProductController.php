<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ProductRequest;
use App\Http\Services\ProductService;
use App\Models\Product;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductController extends ApiController
{
    /*
    |--------------------------------------------------------------------------
    | Product API Controller
    |--------------------------------------------------------------------------
    |
    | @Description : Product Manage
    | @Author : Tarek Monjur.
    | @Email  : tarekmonjur@gmail.com
    |
    */

    use ProductService;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth:'.$this->guard, ['except' => [], 'only' => []]);
        $this->upload_path = $this->upload_path.'product/';
    }

    public function index(Request $request)
    {
        try {
            $this->setTitle()
                ->setFilters($request->all())
                ->getDataModel();
            return $this->jsonResponse($this->data, $this->data['title']);
        } catch (\Exception $e) {
            return $this->jsonResponse(null, $e->getMessage(), 'error', $e->getCode());
        }
    }

    public function show(Request $request)
    {
        try {
            $this->setTitle('view')
                ->setIdSlug($request->id_slug)
                ->setSubList($request->sublist)
                ->setColumns($request->columns)
                ->getDataModel();
            return $this->jsonResponse($this->data, $this->data['title']);
        } catch (\Exception $e) {
            return $this->jsonResponse(null, $e->getMessage(), 'error', $e->getCode());
        }
    }

    public function store(ProductRequest $request)
    {
        try {
            $product = new Product();
            $product->name = $request->name;
            $product->code = $this->getProductCode($request->code);
            $product->code = $this->getProductBarcode($request->barcode);
            $product->slug = $request->slug;
            $product->unit_id = !empty($request->unit_id) ?? null;
            $product->category_id = !empty($request->category_id) ?? null;
            $product->sub_category_id = !empty($request->sub_category_id) ?? null;
            $product->sort = $this->getSortNumber($request->sort);
            $product->original_price = $request->original_price ?? 0;
            $product->regular_price = $request->regular_price ?? 0;
            $product->special_price = $request->special_price ?? 0;
            $product->vat_percent = $request->vat_percent ?? 0;
            $product->stock = $request->stock ?? 0;
            $product->is_stock = $request->is_stock ?? 0;
            $product->is_package = $request->is_package ?? 0;
            $product->is_active = $request->is_active ?? 0;
            $product->is_new = $request->is_new ?? 0;
            $product->description = $request->description;
            $product->created_by = $this->authUser->id;

            if ($image = $this->uploadImage($request)) {
                $product->image = $image;
            }

            if ($product->save()) {
                $this->insertProductVariants($product->id, $request->variants);
                $this->insertProductVariants($product->id, $request->stocks);
                return $this->jsonResponse(null, $this->getTrans('success_msg'));
            } else {
                return $this->jsonResponse(null, $this->getTrans('error_msg'), 'error');
            }
        } catch (\Exception $e) {
            return $this->jsonResponse($e->getMessage(), $this->getTrans('error_msg'), 'error', $e->getCode());
        }
    }


    public function update(ProductRequest $request)
    {
        try {
            $product = Product::find($request->id);
            if (!$product) {
                return $this->jsonResponse('', $this->getTrans('warning_msg'));
            }

            $product->name = $request->name;
            $product->code = $this->getProductCode($request->code);
            $product->code = $this->getProductBarcode($request->barcode);
            $product->slug = $request->slug;
            $product->unit_id = !empty($request->unit_id) ?? null;
            $product->category_id = !empty($request->category_id) ?? null;
            $product->sub_category_id = !empty($request->sub_category_id) ?? null;
            $product->sort = $this->getSortNumber($request->sort);
            $product->original_price = $request->original_price ?? 0;
            $product->regular_price = $request->regular_price ?? 0;
            $product->special_price = $request->special_price ?? 0;
            $product->vat_percent = $request->vat_percent ?? 0;
            $product->stock = $request->stock ?? 0;
            $product->is_stock = $request->is_stock ?? 1;
            $product->is_package = $request->is_package ?? 0;
            $product->is_active = $request->is_active ?? 1;
            $product->is_new = $request->is_new ?? 1;
            $product->description = $request->description;
            $product->created_by = $this->authUser->id;

            if ($image = $this->uploadImage($request)) {
                $product->image = $image;
            }

           if ($product->save()) {
               $this->insertProductVariants($product->id, $request->variants);
               $this->updateProductVariants($product->id, $request->variants);
               $this->deleteProductVariants($product->id, $request->delete_variants);
               $this->insertProductStocks($product->id, $request->stocks);
               $this->updateProductStocks($product->id, $request->stocks);
               $this->deleteProductStocks($product->id, $request->delete_stocks);
               return $this->jsonResponse(null, $this->getTrans('success_msg'));
           } else {
               return $this->jsonResponse(null, $this->getTrans('error_msg'), 'error');
           }
        } catch (\Exception $e) {
            return $this->jsonResponse($e->getMessage(), $this->getTrans('error_msg'), 'error', $e->getCode());
        }
    }

    public function destroy($id)
    {
        try {
            $result = Product::find($id)->delete();
            if ($result) {
                return $this->jsonResponse(null, $this->getTrans('delete_msg'));
            }

            return $this->jsonResponse(null, $this->getTrans('error_msg'), 'error');
        } catch (\Exception $e) {
            return $this->jsonResponse($e->getMessage(), $this->getTrans('error_msg'), 'error', $e->getCode());
        }
    }

    protected function uploadImage($request)
    {
        if ($request->hasFile('image')) {
            $upload_path = $this->upload_path;
            $upload_name = $request->slug.'.'.$request->image->extension();
            $full_upload_path = $upload_path.$upload_name;

            if ($this->makeDir($upload_path)) {
                if (!empty($product->image) && file_exists($full_upload_path)) {
                    unlink($full_upload_path);
                }

                $upload = Image::make($request->image);
                $upload->save($full_upload_path);
                return $upload_name;
            }
        }
        return null;
    }

}

