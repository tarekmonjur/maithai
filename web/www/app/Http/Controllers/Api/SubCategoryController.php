<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\SubCategoryRequest;
use App\Http\Services\SubCategoryService;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SubCategoryController extends ApiController
{
    /*
    |--------------------------------------------------------------------------
    | Product Sub Category API Controller
    |--------------------------------------------------------------------------
    |
    | @Description : Product Sub Category Manage
    | @Author : Tarek Monjur.
    | @Email  : tarekmonjur@gmail.com
    |
    */

    use SubCategoryService;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth:'.$this->guard, ['except' => [], 'only' => []]);
        $this->upload_path = $this->upload_path.'category/';
    }

    public function index(Request $request)
    {
        try {
            $filters = $request->all();
            if (!empty($request->id_slug)) {
                $filters['category_id'] = $request->id_slug;
            }
            $this->setTitle()
                ->setFilters($filters)
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

    public function store(SubCategoryRequest $request)
    {
        try {
            $category = new SubCategory();
            $category->category_id = $request->category_id;
            $category->name = $request->name;
            $category->is_active = $request->is_active ?? 1;
            $category->slug = $request->slug;
            $category->description = $request->description;
            $category->created_by = $this->authUser->id;

            if ($request->hasFile('image')) {
                $upload_path = $this->upload_path;
                if ($this->makeDir($upload_path)) {
                    $upload_name = $request->slug.'.'.$request->image->extension();
                    $upload = Image::make($request->image);
                    $upload->save($upload_path.$upload_name);

                    $category->image = $upload_name;
                }
            }

            if ($category->save()) {
                return $this->jsonResponse(null, $this->getTrans('success_msg'));
            } else {
                return $this->jsonResponse(null, $this->getTrans('error_msg'), 'error');
            }
        } catch (\Exception $e) {
            return $this->jsonResponse($e->getMessage(), $this->getTrans('error_msg'), 'error', $e->getCode());
        }
    }


    public function update(SubCategoryRequest $request)
    {
        try {
            $category = SubCategory::find($request->id);
            if (!$category) {
                return $this->jsonResponse('', $this->getTrans('warning_msg'));
            }

            $category->category_id = $request->category_id;
            $category->name = $request->name;
            $category->is_active = $request->is_active;
            $category->slug = $request->slug;
            $category->description = $request->description;
            $category->updated_by = $this->authUser->id;

            if ($request->hasFile('image')) {
                $upload_path = $this->upload_path;
                $upload_name = $request->slug.'.'.$request->image->extension();
                $full_upload_path = $upload_path.$upload_name;

                if ($this->makeDir($upload_path)) {
                    if (!empty($category->image) && file_exists($full_upload_path)) {
                        unlink($full_upload_path);
                    }

                    $upload = Image::make($request->image);
                    $upload->save($full_upload_path);
                    $category->image = $upload_name;
                }
            }

           if ($category->save()) {
               return $this->jsonResponse(null, $this->getTrans('success_msg'));
           } else {
               return $this->jsonResponse(null, $this->getTrans('error_msg'), 'error');
           }
        } catch (\Exception $e) {
            return $this->jsonResponse($e->getMessage(), $this->getTrans('error_msg'), 'error', $e->getCode());
        }
    }

    public function destroy($id)
    {
        try {
            $result = SubCategory::find($id)->delete();
            if ($result) {
                return $this->jsonResponse(null, $this->getTrans('success_msg'));
            }
            return $this->jsonResponse(null, $this->getTrans('error_msg'), 'error');
        } catch (\Exception $e) {
            return $this->jsonResponse($e->getMessage(), $this->getTrans('error_msg'), 'error', $e->getCode());
        }
    }

}

