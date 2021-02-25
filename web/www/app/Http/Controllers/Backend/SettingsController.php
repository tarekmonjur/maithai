<?php

namespace App\Http\Controllers\Backend;



class SettingsController extends BackendController
{

    /*
    |--------------------------------------------------------------------------
    | Settings Controller
    |--------------------------------------------------------------------------
    |
    | @Description : Settings Manager
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
        $data['scripts'] = ['settings', './../plugins/summernote/summernote-bs4.min'];
        $data['styles'] = ['./../plugins/summernote/summernote-bs4'];
        return view('backend.layouts.main')->with($data);
    }

}
