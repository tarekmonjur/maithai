<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Services\CommonService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;

class FrontendController extends Controller
{
    use CommonService;

    protected $guard = 'customer';

    protected $auth;

    protected $authUser;

    protected $context = [];

    public function __construct()
    {
        $this->middleware(function($request, $next) {
            $this->authUser = Auth::guard($this->guard)->user();
            if (session('access_token')) {
                $request->offsetSet('access_token', session('access_token'));
                $this->authUser = Auth::guard($this->guard)->user();
            }
            View::share('context', $this->getContext());
            return $next($request);
        });
    }

    protected function getContext()
    {
        $this->context['customer'] = $this->getCustomerInfo($this->authUser ? $this->authUser->id : null);
        $this->context['request'] = $this->getRequestContext();
        $this->context['settings'] = $this->getSettings();
//        dd($this->context);
        return $this->context;
    }
}
