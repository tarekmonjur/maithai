<?php

namespace App\Http\Controllers\Backend;

use App\Http\Services\CustomerService;

class CustomerController extends BackendController
{
    use CustomerService;
    /*
    |--------------------------------------------------------------------------
    | Customer Controller
    |--------------------------------------------------------------------------
    |
    | @Description : Customer Manage
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
        $this->data['scripts'] = ['customer'];
        $this->data['styles'] = [];
        return view('backend.layouts.main')->with($this->data);
    }

}
