<?php

namespace App\Http\Controllers\Api;

use App\Models\Settings;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SettingsController extends ApiController
{
    /*
    |--------------------------------------------------------------------------
    | Settings Controller
    |--------------------------------------------------------------------------
    |
    | @Description : Settings Manager
    | @Author : Tarek Monjur.
    | @Email  : tarekmonjur@gmail.com
    |
    */


    public function __construct()
    {
        $this->middleware('auth:user,web');
        parent::__construct();
        $this->upload_path = $this->upload_path.'/';
    }

    public function index(Request $request)
    {
        try {
            $settings = Settings::orderBy('key')->get();
            $settings = collect($settings)->groupBy('key');
            return $this->jsonResponse($settings, trans('settings.default'));
        } catch (\Exception $e) {
            return $this->jsonResponse(null, $e->getMessage(), 'error', $e->getCode());
        }
    }


    public function update(Request $request)
    {
        $rules = [];
        $inputs = $request->all();
        foreach($inputs as $input) {
            if (is_array($input) && $input['require']) {
                $request->offsetSet($input['name'], $input['value']);
                $rules[$input['name']] = 'required';
            }
        }
        $request->validate($rules);

        try {
            foreach($inputs as $key => $input) {
                if (!empty($input) && is_array($input)) {
                    if($input['type'] !== 'file') {
                        Settings::where('id', $input['id'])->update(['value' => $input['value']]);
                    } else {
//                        dd($key, $input[$input['name']], $request->file('0.logo'), $_FILES);
                        if ($request->hasFile($key.'.'.$input['name'])) {
                            $file = $input[$input['name']];
                            $upload_path = $this->upload_path;
                            $upload_name = $input['name'].'.'.$file->extension();
                            $full_upload_path = $upload_path.$upload_name;

                            if ($this->makeDir($upload_path)) {
                                if (!empty($input['name']) && file_exists($full_upload_path)) {
                                    unlink($full_upload_path);
                                }

                                $upload = Image::make($file);
                                $upload->save($full_upload_path);
                                Settings::where('id', $input['id'])->update(['value' => $upload_name]);
                            }
                        }
                    }
                }
            }
            return $this->jsonResponse(null, trans('settings.success_msg'));
        } catch (\Exception $e) {
            return $this->jsonResponse($e->getMessage(), trans('settings.error_msg'), 'error', $e->getCode());
        }
    }

}

