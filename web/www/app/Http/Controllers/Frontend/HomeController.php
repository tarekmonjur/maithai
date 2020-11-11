<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends FrontendController
{
    public function index() {
        return view('frontend.home');
    }

    public function foodOrder() {
        return view('frontend.food-order');
    }

    public function foodPackage() {
        return view('frontend.food-package');
    }


    public function about() {
        return view('frontend.about');
    }


    public function contact() {
        return view('frontend.contact');
    }


    public function termsPolicy() {
        return view('frontend.terms-policy');
    }

}
