<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ApiController extends Controller
{
    protected $guard = 'web';

    public function __construct() {
        Request::input('guard') ? $this->guard = Request::input('guard') : null;
    }

}
