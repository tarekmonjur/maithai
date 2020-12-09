<?php

namespace App\Http\Controllers\Backend;

use App\Http\Services\CategoryService;

class UserController extends BackendController
{
//    use CategoryService;
    /*
    |--------------------------------------------------------------------------
    | Product Category Controller
    |--------------------------------------------------------------------------
    |
    | @Description : Product Category Manage
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
//        $this->setTitle();
//        $this->setColumnsConfig();
//        $this->setFiltersConfig();
        $this->data['scripts'] = [];
        $this->data['styles'] = [];
        return view('backend.layouts.main')->with($this->data);
    }

}
