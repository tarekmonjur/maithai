<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CategoryRequest;
use App\Http\Services\CategoryService;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CategoryController extends ApiController
{
    /*
    |--------------------------------------------------------------------------
    | Product Category API Controller
    |--------------------------------------------------------------------------
    |
    | @Description : Product Category Manage
    | @Author : Tarek Monjur.
    | @Email  : tarekmonjur@gmail.com
    |
    */

    use CategoryService;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth:'.$this->guard, ['except' => [], 'only' => []]);
        $this->upload_path = $this->upload_path.'category/';
    }

    public function index(Request $request)
    {
        try {
            $this->setTitle()
                ->setFilters($request->all())
                ->getDataModel();
            return $this->jsonResponse($this->data, $this->data['title']);
        } catch (\Exception $e) {
            return $this->jsonResponse(null, $e->getMessage(), 'error', $e->getCode());
        }
    }

    public function show(Request $request)
    {
        try {
            $this->setTitle('view')
                ->setIdSlug($request->id_slug)
                ->setSubList($request->sublist)
                ->setColumns($request->columns)
                ->getDataModel();
            return $this->jsonResponse($this->data, $this->data['title']);
        } catch (\Exception $e) {
            return $this->jsonResponse(null, $e->getMessage(), 'error', $e->getCode());
        }
    }

    public function store(CategoryRequest $request)
    {
        try {
            if ($request->has('parent_category') && !empty($request->parent_category)) {
                $category = new SubCategory();
                $category->category_id = $request->parent_category;
            } else {
                $category = new Category();
            }

            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->description = $request->description;

            if ($request->hasFile('image')) {
                $upload_path = $this->upload_path;
                if ($this->makeDir($upload_path)) {
                    $upload_name = $request->slug.'.'.$request->image->extension();
                    $upload = Image::make($request->image);
                    $upload->save($upload_path.$upload_name);

                    $category->image = $upload_name;
                }
            }

            $result = $category->save();

            return $this->jsonResponse($result, $this->getTrans('success_msg'));
        } catch (\Exception $e) {
            return $this->jsonResponse($e->getMessage(), $this->getTrans('error_msg'), 'error');
        }
    }


    public function update(CategoryRequest $request)
    {
        try {
            if ($request->has('parent_category') && !empty($request->parent_category)) {
                $category = SubCategory::find($request->id);
                $category->category_id = $request->parent_category;
            } else {
                $category = Category::find($request->id);
            }

            if (!$category) {
                return $this->jsonResponse('', $this->getTrans('warning_msg'));
            }

            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->description = $request->description;

            if ($request->hasFile('image')) {
                $upload_path = $this->upload_path;
                $upload_name = $request->slug.'.'.$request->image->extension();
                $full_upload_path = $upload_path.$upload_name;

                if ($this->makeDir($upload_path)) {
                    if (!empty($category->image) && file_exists($full_upload_path)) {
                        unlink($full_upload_path);
                    }

                    $upload = Image::make($request->image);
                    $upload->save($upload_path.$upload_name);
                    $category->image = $upload_name;
                }
            }

            $result = $category->save();

            return $this->jsonResponse($result, $this->getTrans('success_msg'));
        } catch (\Exception $e) {
            return $this->jsonResponse($e->getMessage(), $this->getTrans('error_msg'), 'error');
        }
    }

}

