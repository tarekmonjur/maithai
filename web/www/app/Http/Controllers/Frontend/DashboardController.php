<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Services\OrderService;
use App\Models\Customer;
use Illuminate\Http\Request;

class DashboardController extends FrontendController
{
    use OrderService;

    public function __construct()
    {
        $this->middleware('webAuth:'.$this->guard);
        parent::__construct();
    }

    public function index(Request $request) {
//        \Cookie::queue('tarek', '1234567890', 12);
//        dd(\Cookie::get('tarek'), $request->cookie(), $request->session());

        $data['title'] = trans('frontend.home');
        $data['styles'] = [];
        $data['scripts'] = ['home'];
        return view('frontend.layouts.app')->with($data);
    }

    public function myOrder(Request $request) {
        $data['title'] = trans('frontend.my_orders');
        $data['styles'] = [];
        $data['scripts'] = ['my_order'];
        $data['filters'] = $this->setFiltersConfig()->getFiltersConfig();
        return view('frontend.layouts.app')->with($data);
    }

}
