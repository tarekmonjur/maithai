<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\SubVariantRequest;
use App\Http\Services\SubVariantService;
use App\Models\SubVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class SubVariantController extends ApiController
{
    /*
    |--------------------------------------------------------------------------
    | Product Sub Variant API Controller
    |--------------------------------------------------------------------------
    |
    | @Description : Product Sub Variant Manage
    | @Author : Tarek Monjur.
    | @Email  : tarekmonjur@gmail.com
    |
    */

    use SubVariantService;

    public function __construct()
    {
        $this->middleware('auth:user,web');
        parent::__construct();
        $this->upload_path = $this->upload_path.'variant/';
    }

    public function index(Request $request)
    {
        try {
            $filters = $request->all();
            if (!empty($request->id)) {
                $filters['variant_id'] = $request->id;
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
                ->setIdSlug($request->id)
                ->setSubList($request->sublist)
                ->setColumns($request->columns)
                ->getDataModel();
            return $this->jsonResponse($this->data, $this->data['title']);
        } catch (\Exception $e) {
            return $this->jsonResponse(null, $e->getMessage(), 'error', $e->getCode());
        }
    }

    public function store(SubVariantRequest $request)
    {
        try {
            $category = new SubVariant();
            $category->variant_id = $request->variant_id;
            $category->name = $request->name;
            $category->is_active = $request->is_active ?? 1;
            $category->description = $request->description;
            $category->created_by = $this->authUser->id;

            if ($request->hasFile('image')) {
                $upload_path = $this->upload_path;
                if ($this->makeDir($upload_path)) {
                    $upload_name = Str::slug($request->name).'.'.$request->image->extension();
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


    public function update(SubVariantRequest $request)
    {
        try {
            $category = SubVariant::find($request->id);
            if (!$category) {
                return $this->jsonResponse('', $this->getTrans('warning_msg'));
            }

            $category->variant_id = $request->variant_id;
            $category->name = $request->name;
            $category->is_active = $request->is_active;
            $category->description = $request->description;
            $category->updated_by = $this->authUser->id;

            if ($request->hasFile('image')) {
                $upload_path = $this->upload_path;
                $upload_name = Str::slug($request->name).'.'.$request->image->extension();
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
            $result = SubVariant::find($id)->delete();
            if ($result) {
                return $this->jsonResponse(null, $this->getTrans('delete_msg'));
            }
            return $this->jsonResponse(null, $this->getTrans('error_msg'), 'error');
        } catch (\Exception $e) {
            return $this->jsonResponse($e->getMessage(), $this->getTrans('error_msg'), 'error', $e->getCode());
        }
    }

}

