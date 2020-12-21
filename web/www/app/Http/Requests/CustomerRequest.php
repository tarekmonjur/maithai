<?php

namespace App\Http\Requests;

use App\Models\Customer;
use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $tableName = (new Customer())->getTable();

        if ($id = $this->segment(3)) {
            $username = ['required', 'min:3', 'max:45', 'unique:'.$tableName.',username,'.$id];
            $referral_code = ['required', 'min:3', 'max:45', 'unique:'.$tableName.',referral_code,'.$id];
        } else {
            $username = ['required', 'min:3', 'max:45', 'unique:'.$tableName.',username'];
            $referral_code = ['required', 'min:3', 'max:45', 'unique:'.$tableName.',referral_code'];
        }

        return [
            'username' => $username,
            'password' => 'required|min:3|max:45',
            'retype_password' => 'required|min:3|max:45|confirmed:password',
            'referral_code' => $referral_code,
            'first_name' => 'required|min:3|max:45',
            'last_name' => 'nullable|min:3|max:45',
            'email' => 'nullable|email|min:3|max:45',
            'mobile_no' => 'nullable|min:3|max:45',
            'gender' => 'nullable|in:male,female,other',
        ];
    }
}
