<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserRequest;
use App\Http\Services\User\UserService;
use App\Models\User;
use App\Models\UserDetails;
use Carbon\Carbon;
use Faker\Generator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class UserController extends ApiController
{
    /*
    |--------------------------------------------------------------------------
    | User API Controller
    |--------------------------------------------------------------------------
    |
    | @Description : User Manage
    | @Author : Tarek Monjur.
    | @Email  : tarekmonjur@gmail.com
    |
    */

    use UserService;

    public function __construct()
    {
        $this->middleware('auth:user,web');
        parent::__construct();
        $this->upload_path = $this->upload_path.'user/';
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

    public function store(UserRequest $request)
    {
        $facker = Faker::create();
        try {
            DB::beginTransaction();
            $user = new User();
            $user->username = $request->username;
            $user->password = $request->password;
            $user->is_active = $request->is_active ?? 1;
            if ($this->authUser && $this->guard !== 'customer') {
                $user->created_by = $this->authUser->id;
            }

            if (empty($request->username)) {
                $user->username = $facker->userName;
            }
            if (empty($request->password)) {
                $user->password = $facker->password(6, 10);
            }

            if ($user->save()) {
                $details = [
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'mobile_no' => $request->mobile_no,
                    'gender' => $request->gender ?? 'other',
                    'user_type_id' => $request->user_type_id ?? null,
                    'user_service_type_id' => $request->user_service_type_id ?? null,
                    'user_status_id' => $request->user_status_id ?? null,
                    'designation' => $request->designation,
                    'salary' => $request->salary,
                    'date_of_birth' => Carbon::parse($request->date_of_birth)->format('Y-m-d'),
                    'joining_date' => Carbon::parse($request->joining_date)->format('Y-m-d'),
                    'f_name' => $request->father_name,
                    'm_name' => $request->m_name,
                    'present_address' => $request->present_address,
                    'permanent_address' => $request->permanent_address,
                ];
                if ($image = $this->uploadPhoto($request)) {
                    $details['photo'] = $image;
                }
                $user->details()->create($details);
                DB::commit();
                return $this->jsonResponse(null, $this->getTrans('success_msg'));
            } else {
                DB::rollBack();
                return $this->jsonResponse(null, $this->getTrans('error_msg'), 'error');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->jsonResponse($e->getMessage(), $this->getTrans('error_msg'), 'error', $e->getCode());
        }
    }


    public function update(UserRequest $request)
    {
        $facker = Faker::create();

        try {
            DB::beginTransaction();
            $user = User::with('details')->find($request->id);

            if (!$user) {
                return $this->jsonResponse('', $this->getTrans('warning_msg'));
            }

            $user->username = $request->username;
            $user->is_active = $request->is_active ?? 1;
            if ($this->authUser && $this->guard !== 'customer') {
                $user->updated_by = $this->authUser->id;
            }

            if (empty($user->username) && empty($request->username)) {
                $user->username = $facker->userName;
            }

            if (!empty($request->password)) {
                $user->password = $request->password;
            } else if (empty($user->password) && empty($request->password)) {
                $user->password = $facker->password(6, 10);
            }

            if ($user->save()) {
                $details = [
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'mobile_no' => $request->mobile_no,
                    'gender' => $request->gender ?? 'other',
                    'user_type_id' => !$this->isEmpty($request->user_type_id) ?
                        $request->user_type_id : null,
                    'user_service_type_id' => !$this->isEmpty($request->user_service_type_id) ?
                        $request->user_service_type_id : null,
                    'user_status_id' => !$this->isEmpty($request->user_status_id) ?
                        $request->user_status_id : null,
                    'designation' => $request->designation,
                    'salary' => $request->salary,
                    'date_of_birth' => Carbon::parse($request->date_of_birth)->format('Y-m-d'),
                    'joining_date' => Carbon::parse($request->joining_date)->format('Y-m-d'),
                    'f_name' => $request->father_name,
                    'm_name' => $request->m_name,
                    'present_address' => $request->present_address,
                    'permanent_address' => $request->permanent_address,
                ];

                if ($image = $this->uploadPhoto($request)) {
                    $details['photo'] = $image;
                }

                if ($request->get('details.id')) {
                    $details['id'] = $request->get('details.id');
                } else {
                    $details['id'] = $user->details->id;
                }

                UserDetails::where('id', $details['id'])->update($details);
                DB::commit();
                return $this->jsonResponse(null, $this->getTrans('success_msg'));
            } else {
                DB::rollBack();
                return $this->jsonResponse(null, $this->getTrans('error_msg'), 'error');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->jsonResponse($e->getMessage(), $this->getTrans('error_msg'), 'error', $e->getCode());
        }
    }

    public function destroy($id)
    {
        try {
            $result = User::where('id', '>=', 1)
                ->where('id', $id)
                ->delete();
            if ($result) {
                return $this->jsonResponse(null, $this->getTrans('delete_msg'));
            }

            return $this->jsonResponse(null, $this->getTrans('error_msg'), 'error');
        } catch (\Exception $e) {
            return $this->jsonResponse($e->getMessage(), $this->getTrans('error_msg'), 'error', $e->getCode());
        }
    }

    protected function uploadPhoto($request)
    {
        if ($request->hasFile('photo')) {
            $upload_path = $this->upload_path;
            $upload_name = uniqid(Str::slug($request->first_name)).'.'.$request->photo->extension();
            $full_upload_path = $upload_path.$upload_name;

            if ($this->makeDir($upload_path)) {
                if (!empty($product->photo) && file_exists($full_upload_path)) {
                    unlink($full_upload_path);
                }

                $upload = Image::make($request->photo);
                $upload->save($full_upload_path);
                return $upload_name;
            }
        }
        return null;
    }

    protected function isEmpty($value) {
        return empty($value) || $value === 'null' || $value === null;
    }

}

