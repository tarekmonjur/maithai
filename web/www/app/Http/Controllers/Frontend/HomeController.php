<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends FrontendController
{
    public function index() {
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

}
