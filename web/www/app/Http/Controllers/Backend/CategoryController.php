<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Services\CategoryService;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends BackendController
{
    use CategoryService;
    /*
    |--------------------------------------------------------------------------
    | Product Category Controller
    |--------------------------------------------------------------------------
    |
    | @Description : Product Category Manage
    | @Author : Tarek Monjur.
    | @Email  : tarekmonjur@gmail.com
    |
    */

    public function __construct(){
        parent::__construct();
        $this->middleware('auth:web');
    }

    public function index()
    {
        $data =  $this->getDataModel();
        return view('backend.category.index')->with($data);
    }

}
