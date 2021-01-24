<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\TableRequest;
use App\Http\Services\TableService;
use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends ApiController
{
    /*
    |--------------------------------------------------------------------------
    | Table API Controller
    |--------------------------------------------------------------------------
    |
    | @Description : Table Manage
    | @Author : Tarek Monjur.
    | @Email  : tarekmonjur@gmail.com
    |
    */

    use TableService;

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

    public function store(TableRequest $request)
    {
        try {
            $table = new Table();
            $table->table_no = $request->table_no;
            $table->description = $request->description;
            $table->is_active = $request->is_active ?? 1;
            $table->created_by = $this->authUser->id;

            if ($table->save()) {
                return $this->jsonResponse(null, $this->getTrans('success_msg'));
            } else {
                return $this->jsonResponse(null, $this->getTrans('error_msg'), 'error');
            }
        } catch (\Exception $e) {
            return $this->jsonResponse($e->getMessage(), $this->getTrans('error_msg'), 'error', $e->getCode());
        }
    }


    public function update(TableRequest $request)
    {
        try {
            $table = Table::find($request->id);
            if (!$table) {
                return $this->jsonResponse('', $this->getTrans('warning_msg'));
            }

            $table->table_no = $request->table_no;
            $table->description = $request->description;
            $table->is_active = $request->is_active ?? 1;
            $table->created_by = $this->authUser->id;

           if ($table->save()) {
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
            $result = Table::find($id)->delete();
            if ($result) {
                return $this->jsonResponse(null, $this->getTrans('delete_msg'));
            }

            return $this->jsonResponse(null, $this->getTrans('error_msg'), 'error');
        } catch (\Exception $e) {
            return $this->jsonResponse($e->getMessage(), $this->getTrans('error_msg'), 'error', $e->getCode());
        }
    }

}

