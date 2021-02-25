<?php

namespace App\Http\Controllers\Backend;

use App\Http\Services\ProductService;
use App\Models\Category;

class ProductController extends BackendController
{
    use ProductService;
    /*
    |--------------------------------------------------------------------------
    | Product Controller
    |--------------------------------------------------------------------------
    |
    | @Description : Product Manage
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
        $this->setTitle();
        $this->setColumnsConfig();
        $this->setFiltersConfig();
        $categories = Category::select('id as value', 'name as label')->get()->toArray();
        $this->setFiltersConfigData('category_id', $categories);
        $this->data['scripts'] = ['product'];
        $this->data['styles'] = [];
        return view('backend.layouts.main')->with($this->data);
    }

}
