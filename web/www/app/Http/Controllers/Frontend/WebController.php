<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Services\Customer\AuthenticatesCustomers;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class WebController extends FrontendController
{
    use AuthenticatesCustomers;

    public function __construct()
    {
        $this->middleware('webAuth:'.$this->guard, ['only' => ['logout']]);
        $this->middleware('guest:'.$this->guard, ['only' => ['showLogin', 'showRegistration']]);
        parent::__construct();
    }

    public function index(Request $request) {
//        \Cookie::queue('tarek', '1234567890', 12);
//        dd(\Cookie::get('tarek'), $request->cookie(), $request->session());
//        dd($request->wantsJson(), $request->isJson(), $request->expectsJson());

        $data['title'] = trans('frontend.home');
        $data['styles'] = [];
        $data['scripts'] = ['home'];
        return view('frontend.layouts.app')->with($data);
    }

    public function product() {
        $data['title'] = trans('frontend.product');
        $data['styles'] = [];
        $data['scripts'] = ['product'];
        return view('frontend.layouts.app')->with($data);
    }

    public function package() {
        $data['title'] = trans('frontend.package');
        $data['styles'] = [];
        $data['scripts'] = ['package'];
        return view('frontend.layouts.app')->with($data);
    }

    public function about() {
        $data['title'] = trans('frontend.about');
        $data['styles'] = [];
        $data['scripts'] = ['about'];
        return view('frontend.layouts.app')->with($data);
    }

    public function contact() {
        $data['title'] = trans('frontend.contact');
        $data['styles'] = [];
        $data['scripts'] = ['contact'];
        return view('frontend.layouts.app')->with($data);
    }

    public function termsPolicy() {
        $data['title'] = trans('frontend.terms&policy');
        $data['styles'] = [];
        $data['scripts'] = ['policy'];
        return view('frontend.layouts.app')->with($data);
    }

    public function showLogin()
    {
        $data = [];
        $data['title'] = trans('frontend.login');
        $data['styles'] = [];
        $data['scripts'] = ['login'];
        return view('frontend.layouts.app', $data);
    }

    public function showRegistration()
    {
        $data = [];
        $data['title'] = trans('frontend.signup');
        $data['styles'] = [];
        $data['scripts'] = ['signup'];
        return view('frontend.layouts.app', $data);
    }

    public function paymentCancel()
    {
        $data = [];
        $data['data']['payment_status'] = ['cancel'];
        $data['title'] = trans('frontend.payment_cancel');
        $data['styles'] = [];
        $data['scripts'] = ['payment_alert'];
        return view('frontend.layouts.app', $data);
    }

    public function paymentSuccess()
    {
        $data = [];
        $data['data']['payment_status'] = ['success'];
        $data['title'] = trans('frontend.payment_success');
        $data['styles'] = [];
        $data['scripts'] = ['payment_alert'];
        return view('frontend.layouts.app', $data);
    }

}
