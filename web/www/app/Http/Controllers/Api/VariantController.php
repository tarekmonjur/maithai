<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\VariantRequest;
use App\Http\Services\VariantService;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class VariantController extends ApiController
{
    /*
    |--------------------------------------------------------------------------
    | Product Variant API Controller
    |--------------------------------------------------------------------------
    |
    | @Description : Product Variant Manage
    | @Author : Tarek Monjur.
    | @Email  : tarekmonjur@gmail.com
    |
    */

    use VariantService;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth:'.$this->guard, ['except' => [], 'only' => []]);
        $this->upload_path = $this->upload_path.'variant/';
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
                ->setIdSlug($request->id)
                ->setSubList($request->sublist)
                ->setColumns($request->columns)
                ->getDataModel();
            return $this->jsonResponse($this->data, $this->data['title']);
        } catch (\Exception $e) {
            return $this->jsonResponse(null, $e->getMessage(), 'error', $e->getCode());
        }
    }

    public function store(VariantRequest $request)
    {
        try {
            $variant = new Variant();
            $variant->name = $request->name;
            $variant->is_active = $request->is_active ?? 1;
            $variant->description = $request->description;
            $variant->created_by = $this->authUser->id;

            if ($request->hasFile('image')) {
                $upload_path = $this->upload_path;
                if ($this->makeDir($upload_path)) {
                    $upload_name = Str::slug($request->name).'.'.$request->image->extension();
                    $upload = Image::make($request->image);
                    $upload->save($upload_path.$upload_name);

                    $variant->image = $upload_name;
                }
            }

            if ($variant->save()) {
                return $this->jsonResponse(null, $this->getTrans('success_msg'));
            } else {
                return $this->jsonResponse(null, $this->getTrans('error_msg'), 'error');
            }
        } catch (\Exception $e) {
            return $this->jsonResponse($e->getMessage(), $this->getTrans('error_msg'), 'error', $e->getCode());
        }
    }


    public function update(VariantRequest $request)
    {
        try {
            $variant = Variant::find($request->id);
            if (!$variant) {
                return $this->jsonResponse('', $this->getTrans('warning_msg'));
            }

            $variant->name = $request->name;
            $variant->is_active = $request->is_active;
            $variant->description = $request->description;
            $variant->updated_by = $this->authUser->id;

            if ($request->hasFile('image')) {
                $upload_path = $this->upload_path;
                $upload_name = Str::slug($request->slug).'.'.$request->image->extension();
                $full_upload_path = $upload_path.$upload_name;

                if ($this->makeDir($upload_path)) {
                    if (!empty($category->image) && file_exists($full_upload_path)) {
                        unlink($full_upload_path);
                    }

                    $upload = Image::make($request->image);
                    $upload->save($full_upload_path);
                    $variant->image = $upload_name;
                }
            }

           if ($variant->save()) {
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
            $result = Variant::find($id)->delete();
            if ($result) {
                return $this->jsonResponse(null, $this->getTrans('success_msg'));
            }

            return $this->jsonResponse(null, $this->getTrans('error_msg'), 'error');
        } catch (\Exception $e) {
            return $this->jsonResponse($e->getMessage(), $this->getTrans('error_msg'), 'error', $e->getCode());
        }
    }

}

