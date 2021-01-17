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
//            dd(Auth::guard($this->guard));
            $this->authUser = Auth::guard($this->guard)->user();
//            dd($this->authUser->getTable());
            return $next($request);
        });
        $this->context = $this->getContext();
    }

    public function lang(Request $request)
    {
        if ($request->get('force') == true) {
            Cache::forget('lang');
        }
        $strings = Cache::rememberForever('lang', function () use($request) {
            $lang = config('app.locale');

            if ($request->get('frontend') === true) {
                $files = [
                    resource_path('lang/' . $lang . '/auth.php'),
                    resource_path('lang/' . $lang . '/common.php'),
                    resource_path('lang/' . $lang . '/frontend.php'),
                    resource_path('lang/' . $lang . '/customer.php'),
                    resource_path('lang/' . $lang . '/validation.php'),
                    resource_path('lang/' . $lang . '/pagination.php'),
                    resource_path('lang/' . $lang . '/passwords.php'),
                ];
            } else {
                $files = glob(resource_path('lang/' . $lang . '/*.php'));
            }

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
        $this->context['user'] = $this->authUser;
        $this->context['request'] = $this->getRequestContext();
        $this->context['settings'] = $this->getSettings();
        // Mail Config
        Config::set('email.host', $this->context['settings']['email_server']);
        Config::set('email.username', $this->context['settings']['email_username']);
        Config::set('email.password', $this->context['settings']['email_password']);
        $email = !empty($this->context['settings']['support_email']) ?
            $this->context['settings']['support_email'] :
            $this->context['settings']['email'];
        Config::set('email.from.address', $email);
        Config::set('email.from.name', $this->context['settings']['name']);
        Config::set('email.to.address', $email);
        Config::set('email.to.name', $this->context['settings']['name']);

//        dd($this->context);
        return $this->context;
    }

    public function sendContactMessage(ContactRequest $request)
    {
        try {
            $data = [];
            $data['name'] = ucfirst($request->first_name.' '.$request->last_name);
            $data['email'] = $request->email;
            $data['message'] = $request->message;
            $to_email = Config::get('email.to.address');

            if (Mail::to($to_email)->send(new CustomerContact($data))) {
                return $this->jsonResponse(null, trans('frontend.contact_success_msg'), 'success');
            }

            return $this->jsonResponse(null, trans('frontend.contact_error_msg'), 'error');
        } catch (\Exception $e) {
            return $this->jsonResponse(null, $e->getMessage(), 'error', $e->getCode());
        }

    }

}
