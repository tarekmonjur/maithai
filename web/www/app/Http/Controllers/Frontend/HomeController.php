<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends FrontendController
{
    public function index() {
        $data['title'] = trans('frontend.home_page_title');
        $data['styles'] = [];
        $data['scripts'] = ['home'];
        return view('frontend.layouts.main')->with($data);
    }

    public function product() {
        $data['title'] = trans('frontend.product_page_title');
        $data['styles'] = [];
        $data['scripts'] = ['product'];
        return view('frontend.layouts.main')->with($data);
    }

    public function package() {
        $data['title'] = trans('frontend.package_page_title');
        $data['styles'] = [];
        $data['scripts'] = ['package'];
        return view('frontend.layouts.main')->with($data);
    }


    public function about() {
        $data['title'] = trans('frontend.about_page_title');
        return view('frontend.about')->with($data);
    }


    public function contact() {
        $data['title'] = trans('frontend.contact_page_title');
        return view('frontend.contact')->with($data);
    }


    public function termsPolicy() {
        $data['title'] = trans('frontend.policy_page_title');
        return view('frontend.terms-policy')->with($data);
    }

}
