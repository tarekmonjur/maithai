<?php

namespace App\Http\Controllers\Api;

use App\Models\UserType;
use Illuminate\Http\Request;

class UserTypeController extends ApiController
{
    /*
    |--------------------------------------------------------------------------
    | User Type API Controller
    |--------------------------------------------------------------------------
    |
    | @Description : User Type Manage
    | @Author : Tarek Monjur.
    | @Email  : tarekmonjur@gmail.com
    |
    */

    public function __construct()
    {
        $this->middleware('auth:user,web');
        parent::__construct();
    }

    public function index()
    {
        try {
            $data['results'] = UserType::where('is_active', 1)
                ->get()
                ->toArray();
            return $this->jsonResponse($data, '');
        } catch (\Exception $e) {
            return $this->jsonResponse(null, $e->getMessage(), 'error', $e->getCode());
        }
    }

}

