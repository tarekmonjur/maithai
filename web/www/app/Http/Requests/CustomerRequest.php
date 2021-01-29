<?php

namespace App\Http\Requests;

use App\Models\Customer;
use App\Models\CustomerDetails;
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
        $tableName2 = (new CustomerDetails())->getTable();
        $segments = $this->segments();

        $id = null;
        if (is_integer(intval(end($segments)))) {
            $id = end($segments);
        } else if ($this->request->get('customer_id')) {
            $id = $this->request->get('customer_id');
        }

        $details_id = null;
        if ($this->request->get('details_id')) {
            $details_id = $this->request->get('details_id');
        }

        if ($id) {
            $username = ['required', 'min:3', 'max:45', 'unique:'.$tableName.',username,'.$id];
            $email = ['nullable', 'email', 'min:3', 'max:45', 'unique:'.$tableName2.',email,'.$details_id];
            $mobile_no = ['nullable', 'min:3', 'max:45', 'unique:'.$tableName2.',mobile_no,'.$details_id];
        } else {
            $username = ['required', 'min:3', 'max:45', 'unique:'.$tableName.',username'];
            $email = ['nullable', 'email', 'min:3', 'max:45', 'unique:'.$tableName2.',email'];
            $mobile_no = ['nullable', 'min:3', 'max:45', 'unique:'.$tableName2.',mobile_no'];
        }

        return [
            'username' => $username,
            'password' => 'required|min:6|max:45',
            'retype_password' => 'required|min:6|max:45|same:password',
            'first_name' => 'required|alpha|min:3|max:45',
            'last_name' => 'nullable|alpha|min:3|max:45',
            'email' => $email,
            'mobile_no' => $mobile_no,
            'gender' => 'nullable|in:male,female,other',
            'address' => 'nullable|max:255',
        ];
    }
}
