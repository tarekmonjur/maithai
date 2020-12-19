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
        } else {
            $name = ['required', 'min:2', 'max:45', 'unique:'.$tableName.',name'];
        }

        return [
            'name' => $name,
            'description' => 'nullable|max:255'
        ];
    }
}
