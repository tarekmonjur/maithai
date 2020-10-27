<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends BackendController
{
    public function __construct() {
        parent::__construct();
        $this->middleware('auth');
    }

    public function index()
    {
        $data['title'] = "Dashboard";
        return view('backend.dashboard')->with($data);
    }
}
