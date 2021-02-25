<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\SkuRequest;
use App\Http\Services\SkuService;
use App\Models\Sku;
use Illuminate\Http\Request;

class SkuController extends ApiController
{
    /*
    |--------------------------------------------------------------------------
    | Product Sku API Controller
    |--------------------------------------------------------------------------
    |
    | @Description : Product Sku Manage
    | @Author : Tarek Monjur.
    | @Email  : tarekmonjur@gmail.com
    |
    */

    use SkuService;

    public function __construct()
    {
        $this->middleware('auth:user,web');
        parent::__construct();
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
                ->setIdSlug($request->id)
                ->setSubList($request->sublist)
                ->setColumns($request->columns)
                ->getDataModel();
            return $this->jsonResponse($this->data, $this->data['title']);
        } catch (\Exception $e) {
            return $this->jsonResponse(null, $e->getMessage(), 'error', $e->getCode());
        }
    }

    public function store(SkuRequest $request)
    {
        try {
            $sku = new Sku();
            $sku->name = $request->name;
            $sku->code = $request->code;
            $sku->location = $request->location;
            $sku->is_active = $request->is_active ?? 1;
            $sku->created_by = $this->authUser->id;

            if ($sku->save()) {
                return $this->jsonResponse(null, $this->getTrans('success_msg'));
            } else {
                return $this->jsonResponse(null, $this->getTrans('error_msg'), 'error');
            }
        } catch (\Exception $e) {
            return $this->jsonResponse($e->getMessage(), $this->getTrans('error_msg'), 'error', $e->getCode());
        }
    }


    public function update(SkuRequest $request)
    {
        try {
            $sku = Sku::find($request->id);
            if (!$sku) {
                return $this->jsonResponse('', $this->getTrans('warning_msg'));
            }

            $sku->name = $request->name;
            $sku->code = $request->code;
            $sku->location = $request->location;
            $sku->is_active = $request->is_active;
            $sku->updated_by = $this->authUser->id;

           if ($sku->save()) {
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
            $result = Sku::find($id)->delete();
            if ($result) {
                return $this->jsonResponse(null, $this->getTrans('delete_msg'));
            }

            return $this->jsonResponse(null, $this->getTrans('error_msg'), 'error');
        } catch (\Exception $e) {
            return $this->jsonResponse($e->getMessage(), $this->getTrans('error_msg'), 'error', $e->getCode());
        }
    }

}

