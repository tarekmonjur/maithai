<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CategoryRequest;
use App\Http\Services\CategoryService;
use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class DashboardController extends ApiController
{
    /*
    |--------------------------------------------------------------------------
    | Frontend API Controller
    |--------------------------------------------------------------------------
    |
    | @Description : Frontend Manage
    | @Author : Tarek Monjur.
    | @Email  : tarekmonjur@gmail.com
    |
    */

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth:'.$this->guard, ['except' => [], 'only' => []]);
        $this->upload_path = $this->upload_path.'/';
    }

    public function index(Request $request)
    {

    }

}

