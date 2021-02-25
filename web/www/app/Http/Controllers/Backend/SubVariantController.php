<?php

namespace App\Http\Controllers\Backend;

use App\Http\Services\SubVariantService;

class SubVariantController extends BackendController
{
    use SubVariantService;
    /*
    |--------------------------------------------------------------------------
    | Product Variant Controller
    |--------------------------------------------------------------------------
    |
    | @Description : Product Variant Manage
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
        $this->data['scripts'] = ['sub_variant'];
        $this->data['styles'] = [];
        return view('backend.layouts.main')->with($this->data);
    }

}
