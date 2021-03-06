<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CustomerRequest;
use App\Http\Services\Customer\CustomerService;
use App\Models\Customer;
use App\Models\CustomerDetails;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class CustomerController extends ApiController
{
    /*
    |--------------------------------------------------------------------------
    | Customer API Controller
    |--------------------------------------------------------------------------
    |
    | @Description : Customer Manage
    | @Author : Tarek Monjur.
    | @Email  : tarekmonjur@gmail.com
    |
    */

    use CustomerService;

    public function __construct()
    {
        $this->middleware('auth:user,web', ['except' => ['store', 'update']]);
        parent::__construct();
        $this->upload_path = $this->upload_path.'customer/';
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

    public function store(CustomerRequest $request)
    {
        $facker = Faker::create();
        try {
            DB::beginTransaction();
            $customer = new Customer();
            if (empty($request->username)) {
                $customer->username = $facker->userName;
            }
            if (empty($request->password)) {
                $customer->password = $facker->password(6, 10);
            }
            $customer->referrer_id = $this->getReferrerId($request->input('referrer_code'));
            $customer->referral_code = $this->generateReferralCode($request->first_name);
            $customer->is_membership = $request->is_membership ?? 0;
            $customer->is_active = $request->is_active ?? 1;
            $customer->email_verified = $request->email_verified ?? 0;
            $customer->email_verified_at = $request->email_verified_at ?? null;
            if ($this->authUser && $this->guard !== 'customer') {
                $customer->created_by = $this->authUser->id;
            }

            if ($customer->save()) {
                $details = [
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'mobile_no' => $request->mobile_no,
                    'gender' => $request->gender ?? 'other',
                    'city' => $request->city,
                    'state' => $request->state,
                    'zip_code' => $request->zip_code,
                    'address' => $request->address,
                ];
                if ($image = $this->uploadPhoto($request)) {
                    $details['photo'] = $image;
                }
                $customer->details()->create($details);
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


    public function update(CustomerRequest $request)
    {
        $facker = Faker::create();
        try {
            DB::beginTransaction();
            $customer = Customer::with('details')->find($request->id);
            if (!$customer) {
                return $this->jsonResponse('', $this->getTrans('warning_msg'));
            }

            if (empty($customer->username) && empty($request->username)) {
                $customer->username = $facker->userName;
            }

            if (!empty($request->password)) {
                $customer->password = $request->password;
            }

            if ($this->authUser && $this->guard !== 'customer') {
                $customer->referral_code = $request->referral_code;
                $customer->referrer_id = $this->getReferrerId($request->input('referrer_code'));
            }

            $customer->is_membership = $request->is_membership ?? 0;
            $customer->is_active = $request->is_active ?? 1;
            $customer->email_verified = $request->email_verified ?? 0;
            $customer->email_verified_at = $request->email_verified_at ?? null;

            if ($this->authUser && $this->guard !== 'customer') {
                $customer->update_by = $this->authUser->id;
            }

            if ($customer->save()) {
                $details = [
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'mobile_no' => $request->mobile_no,
                    'gender' => $request->gender,
                    'city' => $request->city,
                    'state' => $request->state,
                    'zip_code' => $request->zip_code,
                    'address' => $request->address,
                ];
                if ($image = $this->uploadPhoto($request)) {
                    $details['photo'] = $image;
                }
                if ($request->get('details.id')) {
                    $details['id'] = $request->get('details.id');
                } else {
                    $details['id'] = $customer->details->id;
                }
                CustomerDetails::where('id', $details['id'])->update($details);
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
            $result = Customer::find($id)->delete();
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

}

