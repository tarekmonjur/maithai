<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Services\CommonService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class BackendController extends Controller
{
    use CommonService;

    protected $auth;

    protected $authUser;

    protected $context = [];

    public function __construct() {
        $this->middleware(function($request, $next) {
            $this->auth = Auth::guard('web');
            $auth_id = $this->auth->id();
            $userInfo = $this->getUserInfo($auth_id);
            $this->authUser = $userInfo;
            View::share('auth', $userInfo);
            View::share('context', $this->getContext());
            return $next($request);
        });
    }

    protected function getContext()
    {
        $this->context['user'] = $this->authUser;
        $this->context['request'] = $this->getRequestContext();
//        dd($this->context);
        return $this->context;
    }

}
