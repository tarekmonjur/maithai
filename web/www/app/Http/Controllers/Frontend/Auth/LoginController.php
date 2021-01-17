<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Frontend\FrontendController;
use App\Providers\RouteServiceProvider;
use App\Http\Services\Customer\AuthenticatesCustomers;

class LoginController extends FrontendController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesCustomers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::FRONTEND_HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest:customer')->except('logout');
    }
}
