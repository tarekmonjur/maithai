<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CategoryRequest;
use App\Http\Services\CategoryService;
use App\Models\Category;
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
        $this->middleware('auth:user,web', ['except' => ['index', 'show']]);
        parent::__construct();
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
            $category = new Category();
            $category->name = $request->name;
            $category->sort = $this->getSortNumber($request->sort);
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


    public function update(CategoryRequest $request)
    {
        try {
            $category = Category::find($request->id);
            if (!$category) {
                return $this->jsonResponse('', $this->getTrans('warning_msg'));
            }

            $category->name = $request->name;
            $category->sort = $this->getSortNumber($request->sort);
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
            $result = Category::find($id)->delete();
            if ($result) {
                return $this->jsonResponse(null, $this->getTrans('delete_msg'));
            }

            return $this->jsonResponse(null, $this->getTrans('error_msg'), 'error');
        } catch (\Exception $e) {
            return $this->jsonResponse($e->getMessage(), $this->getTrans('error_msg'), 'error', $e->getCode());
        }
    }

}

