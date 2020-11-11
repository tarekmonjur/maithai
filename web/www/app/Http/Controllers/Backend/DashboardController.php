<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends BackendController
{
    /*
    |--------------------------------------------------------------------------
    | Backend Dashboard Controller
    |--------------------------------------------------------------------------
    |
    | @Description : Dashboard Chart and Report
    | @Author : Tarek Monjur.
    | @Email  : tarekmonjur@gmail.com
    |
    */

    public function __construct() {
        parent::__construct();
        $this->middleware('auth:web');
    }

    public function index()
    {
        $data['title'] = "Dashboard";
        return view('backend.dashboard')->with($data);
    }
}
