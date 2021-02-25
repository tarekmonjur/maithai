<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UnitRequest;
use App\Http\Services\UnitService;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends ApiController
{
    /*
    |--------------------------------------------------------------------------
    | Product Unit API Controller
    |--------------------------------------------------------------------------
    |
    | @Description : Product Unit Manage
    | @Author : Tarek Monjur.
    | @Email  : tarekmonjur@gmail.com
    |
    */

    use UnitService;

    public function __construct()
    {
        $this->middleware('auth:user,web');
        parent::__construct();
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

    public function store(UnitRequest $request)
    {
        try {
            $unit = new Unit();
            $unit->name = $request->name;
            $unit->is_active = $request->is_active ?? 1;
            $unit->created_by = $this->authUser->id;

            if ($unit->save()) {
                return $this->jsonResponse(null, $this->getTrans('success_msg'));
            } else {
                return $this->jsonResponse(null, $this->getTrans('error_msg'), 'error');
            }
        } catch (\Exception $e) {
            return $this->jsonResponse($e->getMessage(), $this->getTrans('error_msg'), 'error', $e->getCode());
        }
    }


    public function update(UnitRequest $request)
    {
        try {
            $unit = Unit::find($request->id);
            if (!$unit) {
                return $this->jsonResponse('', $this->getTrans('warning_msg'));
            }

            $unit->name = $request->name;
            $unit->is_active = $request->is_active;
            $unit->updated_by = $this->authUser->id;

           if ($unit->save()) {
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
            $result = Unit::find($id)->delete();
            if ($result) {
                return $this->jsonResponse(null, $this->getTrans('delete_msg'));
            }

            return $this->jsonResponse(null, $this->getTrans('error_msg'), 'error');
        } catch (\Exception $e) {
            return $this->jsonResponse($e->getMessage(), $this->getTrans('error_msg'), 'error', $e->getCode());
        }
    }

}

