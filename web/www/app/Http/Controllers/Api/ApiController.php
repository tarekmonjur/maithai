<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\CommonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Request as FRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ApiController extends Controller
{
    use CommonService;

    protected $guard = 'web';

    protected $upload_path;

    public function __construct() {
        FRequest::has('guard') ? $this->guard = FRequest::input('guard') : null;
        $this->upload_path = config('app.upload_path');
    }

    public function lang(Request $request)
    {
        if ($request->get('force') == true) {
            Cache::forget('lang');
        }
        $strings = Cache::rememberForever('lang', function () {
            $lang = config('app.locale');

            $files   = glob(resource_path('lang/' . $lang . '/*.php'));
            $strings = [];

            foreach ($files as $file) {
                $name           = basename($file, '.php');
                $strings[$name] = require $file;
            }

            return $strings;
        });
        return $this->jsonResponse($strings);
    }

}
