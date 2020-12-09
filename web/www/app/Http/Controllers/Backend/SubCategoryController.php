<?php

namespace App\Http\Controllers\Backend;

use App\Http\Services\SubCategoryService;

class SubCategoryController extends BackendController
{
    use SubCategoryService;
    /*
    |--------------------------------------------------------------------------
    | Product Sub Category Controller
    |--------------------------------------------------------------------------
    |
    | @Description : Product Sub Category Manage
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
        $this->data['scripts'] = ['sub_category'];
        $this->data['styles'] = [];
        return view('backend.layouts.main')->with($this->data);
    }

}
