<?php


namespace App\Http\Services\User;


use App\Models\User;

trait UserService
{

    public function getUserInfo($userId) {
        $user = User::with('details')->find($userId);
        $userInfo = $user->toArray();
        $userInfo['details']['full_name'] = $user->details->full_name;
        return $userInfo;
    }

}