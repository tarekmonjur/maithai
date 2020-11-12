<?php

namespace App\Http\Controllers\Api;

use App\Http\Services\CategoryService;
use App\Http\Services\CommonService;
use Illuminate\Http\Request;

class CategoryController extends ApiController
{
    use CommonService, CategoryService;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth:'.$this->guard, ['except' => []]);
    }

    public function index()
    {
        $data = $this->setTitle('list')->getDataModel();
        return $this->jsonResponse($data['results'], $data['title']);
    }
}
