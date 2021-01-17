<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Services\CommonService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class FrontendController extends Controller
{
    use CommonService;

    protected $auth;

    protected $authCustomer;

    protected $context = [];

    public function __construct()
    {
        $this->middleware(function($request, $next) {
            $this->auth = Auth::guard('customer');
            $auth_id = $this->auth->id();
            $customerInfo = $this->getCustomerInfo($auth_id);
            $this->authCustomer = $customerInfo;
            View::share('auth', $this->authCustomer);
            View::share('context', $this->getContext());
            return $next($request);
        });
    }

    protected function getContext()
    {
        $this->context['customer'] = $this->authCustomer;
        $this->context['request'] = $this->getRequestContext();
        $this->context['settings'] = $this->getSettings();
//        dd($this->context);
        return $this->context;
    }
}
