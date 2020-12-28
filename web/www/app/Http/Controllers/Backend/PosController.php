<?php

namespace App\Http\Controllers\Backend;

use App\Http\Services\ProductService;
use App\Models\Category;

class PosController extends BackendController
{
    use ProductService;
    /*
    |--------------------------------------------------------------------------
    | Pos Controller
    |--------------------------------------------------------------------------
    |
    | @Description : Pos Manage
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
        $this->data['scripts'] = ['pos'];
        $this->data['styles'] = [];
        $this->data['sidebar_collapse'] = true;
        return view('backend.layouts.main')->with($this->data);
    }

}
