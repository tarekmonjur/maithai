<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class BackendController extends Controller
{
    use UserService;

    public function __construct() {
        $this->middleware(function($request, $next) {
            $auth_id = Auth::guard('web')->id();
            $userInfo = $this->getUserInfo($auth_id);
            View::share('auth', $userInfo);
            return $next($request);
        });

    }

}
