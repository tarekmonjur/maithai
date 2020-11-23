<?php

namespace App\Http\Controllers\Api;

use App\Http\Services\CategoryService;
use App\Http\Services\CommonService;
use Illuminate\Http\Request;

class CategoryController extends ApiController
{
    /*
    |--------------------------------------------------------------------------
    | Product Category API Controller
    |--------------------------------------------------------------------------
    |
    | @Description : Product Category Manage
    | @Author : Tarek Monjur.
    | @Email  : tarekmonjur@gmail.com
    |
    */

    use CategoryService;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth:'.$this->guard, ['except' => [], 'only' => []]);
    }

    public function index()
    {
        try {
            $this->initData()->getDataModel();
            return $this->jsonResponse($this->data, $this->data['title']);
        } catch (\Exception $e) {
            return $this->jsonResponse(null, $e->getMessage(), 'error', $e->getCode());
        }

    }
}
