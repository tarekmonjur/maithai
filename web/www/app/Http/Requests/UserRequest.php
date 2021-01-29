<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $tableName = (new User())->getTable();
        $tableName2 = (new UserDetails())->getTable();
        $segments = $this->segments();

        $id = null;
        if (is_integer(intval(end($segments)))) {
            $id = end($segments);
        } else if ($this->request->get('user_id')) {
            $id = $this->request->get('user_id');
        }

        $details_id = null;
        if ($this->request->get('details_id')) {
            $details_id = $this->request->get('details_id');
        }

        if ($id) {
            $username = ['nullable', 'min:3', 'max:45', 'unique:'.$tableName.',username,'.$id];
            $email = ['nullable', 'email', 'min:3', 'max:45', 'unique:'.$tableName2.',email,'.$details_id];
            $mobile_no = ['nullable', 'min:3', 'max:45', 'unique:'.$tableName2.',mobile_no,'.$details_id];
        } else {
            $username = ['nullable', 'min:3', 'max:45', 'unique:'.$tableName.',username'];
            $email = ['nullable', 'email', 'min:3', 'max:45', 'unique:'.$tableName2.',email'];
            $mobile_no = ['nullable', 'min:3', 'max:45', 'unique:'.$tableName2.',mobile_no'];
        }

        return [
            'username' => $username,
            'password' => 'nullable|min:6|max:45',
            'retype_password' => 'nullable|min:6|max:45|same:password',
            'first_name' => 'required|alpha|min:3|max:45',
            'last_name' => 'nullable|alpha|min:3|max:45',
            'email' => $email,
            'mobile_no' => $mobile_no,
            'gender' => 'nullable|in:male,female,other',
            'designation' => 'nullable|max:45',
            'salary' => 'nullable|numeric',
            'father_name' => 'nullable|max:45',
            'mother_name' => 'nullable|max:45',
            'present_address' => 'nullable|max:255',
            'permanent_address' => 'nullable|max:255',
        ];
    }
}
