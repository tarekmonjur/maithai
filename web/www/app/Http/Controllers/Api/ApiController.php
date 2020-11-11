<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ApiController extends Controller
{
    protected $guard = 'user';

    public function __construct() {
        $this->guard = Request::input('guard');
    }

}
