<?php

namespace App\Http\Controllers\Api;

use App\Models\UserServiceType;
use Illuminate\Http\Request;

class UserServiceController extends ApiController
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
            $data['results'] = UserServiceType::where('is_active', 1)
                ->get()
                ->toArray();
            return $this->jsonResponse($data, '');
        } catch (\Exception $e) {
            return $this->jsonResponse(null, $e->getMessage(), 'error', $e->getCode());
        }
    }

}

