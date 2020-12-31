<?php

namespace App\Http\Controllers\Backend;


class PosController extends BackendController
{
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
        $this->data['title'] = 'POS';
        $this->data['scripts'] = ['pos'];
        $this->data['styles'] = [];
        $this->data['sidebar_collapse'] = true;
        return view('backend.layouts.main')->with($this->data);
    }

}
