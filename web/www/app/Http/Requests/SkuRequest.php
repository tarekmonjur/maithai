<?php

namespace App\Http\Requests;

use App\Models\Sku;
use Illuminate\Foundation\Http\FormRequest;

class SkuRequest extends FormRequest
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
        $tableName = (new Sku())->getTable();

        if ($id = $this->segment(3)) {
            $name = ['required', 'min:2', 'max:45', 'unique:'.$tableName.',name,'.$id];
            $code = ['required', 'min:2', 'max:45', 'unique:'.$tableName.',code,'.$id];
        } else {
            $name = ['required', 'min:2', 'max:45', 'unique:'.$tableName.',name'];
            $code = ['required', 'min:2', 'max:45', 'unique:'.$tableName.',code'];
        }

        return [
            'name' => $name,
            'code' => $code,
            'location' => 'nullable|max:255'
        ];
    }
}
