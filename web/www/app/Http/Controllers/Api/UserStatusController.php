<?php

namespace App\Http\Controllers\Api;

use App\Models\UserStatus;
use Illuminate\Http\Request;

class UserStatusController extends ApiController
{
    /*
    |--------------------------------------------------------------------------
    | User Status API Controller
    |--------------------------------------------------------------------------
    |
    | @Description : User Status Manage
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
            $data['results'] = UserStatus::where('is_active', 1)
                ->get()
                ->toArray();
            return $this->jsonResponse($data, '');
        } catch (\Exception $e) {
            return $this->jsonResponse(null, $e->getMessage(), 'error', $e->getCode());
        }
    }

}

