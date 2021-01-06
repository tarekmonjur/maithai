<?php

namespace App\Http\Controllers\Backend;

use App\Http\Services\TableService;

class TableController extends BackendController
{
    use TableService;
    /*
    |--------------------------------------------------------------------------
    | Table Controller
    |--------------------------------------------------------------------------
    |
    | @Description : Table Manage
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
        $this->data['scripts'] = ['table'];
        $this->data['styles'] = [];
        return view('backend.layouts.main')->with($this->data);
    }

}
