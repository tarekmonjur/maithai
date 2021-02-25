<?php
/**
 * CommonService
 * @author : Tarek Monjur
 * @email : tarekmonjur@gmail.com
 */

namespace App\Http\Services;

use App\Models\Settings;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\Request;

trait CommonService
{
    /**
     * @description set the json response format
     * @param object $results
     * @param string $status
     * @param number $code
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     * @author Tarek Monjur
     */
    protected function jsonResponse($results = null, $message = '', $status = 'success', $code = 200)
    {
        $jsonData['status'] = $status;
        $code = intval($code);
        $code = ($status === 'error') ? ($code > 100 && $code < 599) ? $code : 500 : $code;
        $jsonData['code'] = $code;
        $jsonData['message'] = $message;
        $jsonData['results'] = $results;
        return response()->json($jsonData,$code);
    }

    protected function makeDir($path)
    {
        if ($path && !is_dir($path)) {
            if (!mkdir($path)) {
                return false;
            }
        }
        return true;
    }

    protected static function getUserInfo($userId)
    {
        $userInfo = [];
        $user = User::with('details')->find($userId);
        if ($user) {
            $userInfo = $user->toArray();
            $userInfo['details']['full_name'] = $user->details->full_name;
        }
        return $userInfo;
    }

    protected static function getCustomerInfo($customer_id)
    {
        $customerInfo = [];
        $customer = Customer::with('details')->find($customer_id);
        if ($customer) {
            $customerInfo = $customer->toArray();
            $customerInfo['details']['full_name'] = $customer->details->full_name;
        }
        return $customerInfo;
    }

    protected static function getRequestContext()
    {
        $data = [];
        $data['route'] = [
            'name' => Request::route()->getName(),
            'prefix' => Request::route()->getPrefix(),
            'domain' => Request::route()->getDomain(),
        ];
        $data['url'] = Request::url();
        $data['path'] = Request::path();
        $data['query'] = Request::query();
        $data['method'] = Request::method();
        $data['segments'] = Request::segments();
        $data['id'] = Request::has('id') ? Request::input('id') : intval(end($data['segments']));
        return $data;
    }

    protected function getSettings($key = null, $name = null)
    {
        if (!empty($name)) {
            $settings = Settings::where('name', $name)->first();
            if ($settings) {
                return $settings->value;
            }
            return null;
        }

        if (!empty($key)) {
            $settings = Settings::where('key', $key)
                ->pluck('value', 'name')
                ->toArray();
        } else {
            $settings = Settings::get()
                ->pluck('value', 'name')
                ->toArray();
            $settings['logo'] = config('app.asset_path').$settings['logo'];
            $settings['qrcode'] = config('app.asset_path').$settings['qrcode'];
            $settings['rating_image'] = config('app.asset_path').$settings['rating_image'];
            $settings['payment_image'] = config('app.asset_path').$settings['payment_image'];
        }

        return $settings;
    }

}
