<?php

namespace App\Http\Controllers\Backend;

use App\Http\Services\UnitService;

class UnitController extends BackendController
{
    use UnitService;
    /*
    |--------------------------------------------------------------------------
    | Product Unit Controller
    |--------------------------------------------------------------------------
    |
    | @Description : Product Unit Manage
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
        $this->data['scripts'] = ['unit'];
        $this->data['styles'] = [];
        return view('backend.layouts.main')->with($this->data);
    }

}
