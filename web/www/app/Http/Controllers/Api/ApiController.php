<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Http\Services\CommonService;
use App\Mail\CustomerContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request as FRequest;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    use CommonService;

    protected $guard = 'web';

    protected $upload_path;

    protected $authUser;

    protected $context = [];

    public function __construct() {
        FRequest::has('guard') ? $this->guard = FRequest::input('guard') : null;
        $this->upload_path = config('app.upload_path');
        $this->middleware(function($request, $next) {
            $this->authUser = Auth::guard($this->guard)->user();
            return $next($request);
        });
    }

    public function lang(Request $request)
    {
        if ($request->get('force') == true) {
            Cache::forget('lang');
        }
        $strings = Cache::rememberForever('lang', function () use($request) {
            $lang = config('app.locale');

            $files = glob(resource_path('lang/' . $lang . '/*.php'));

            $strings = [];
            foreach ($files as $file) {
                $name           = basename($file, '.php');
                $strings[$name] = require $file;
            }

            return $strings;
        });
        return $this->jsonResponse($strings);
    }

    protected function getContext()
    {
        $userInfo = $this->getUserInfo($this->authUser ? $this->authUser->id : null);
        $this->context['user'] = $userInfo;
        $this->context['request'] = $this->getRequestContext();
        $this->context['settings'] = $this->getSettings();
        // Mail Config
        $this->setConfigs($this->context['settings']);
//        dd($this->context);
        return $this->context;
    }

    protected function setConfigs($settings)
    {
        Config::set('mail.host', $settings['email_server']);
        Config::set('mail.port', $settings['email_server_port']);
        Config::set('mail.username', $settings['email_username']);
        Config::set('mail.password', $settings['email_password']);
        $email = !empty($settings['support_email']) ?
            $settings['support_email'] :
            $settings['email'];
        Config::set('mail.from.address', $email);
        Config::set('mail.from.name', $settings['name']);
//        Config::set('mail.to.address', $email);
//        Config::set('mail.to.name', $settings['name']);
    }

    public function sendContactMessage(ContactRequest $request)
    {
        try {
            $this->getContext();
            $data = [];
            $data['name'] = ucfirst($request->first_name.' '.$request->last_name);
            $data['email'] = $request->email;
            $data['message'] = $request->message;
            $to_email = Config::get('mail.from.address');
            Mail::to($to_email)->send(new CustomerContact($data));
            return $this->jsonResponse(null, trans('frontend.contact_success_msg'), 'success');
        } catch (\Exception $e) {
            return $this->jsonResponse(null, $e->getMessage(), 'error', $e->getCode());
        }
    }

}
