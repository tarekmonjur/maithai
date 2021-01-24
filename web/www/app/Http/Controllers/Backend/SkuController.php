<?php

namespace App\Http\Controllers\Backend;

use App\Http\Services\SkuService;

class SkuController extends BackendController
{
    use SkuService;
    /*
    |--------------------------------------------------------------------------
    | Product SkuService Controller
    |--------------------------------------------------------------------------
    |
    | @Description : Product SkuService Manage
    | @Author : Tarek Monjur.
    | @Email  : tarekmonjur@gmail.com
    |
    */

    public function __construct(){
        parent::__construct();
        $this->middleware('auth:web');
    }

    public function index()
    {
        $this->setTitle();
        $this->setColumnsConfig();
        $this->setFiltersConfig();
        $this->data['scripts'] = ['sku'];
        $this->data['styles'] = [];
        return view('backend.layouts.main')->with($this->data);
    }

}
