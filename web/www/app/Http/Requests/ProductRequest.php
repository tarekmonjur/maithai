<?php

namespace App\Http\Requests;

use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class ProductRequest extends FormRequest
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
        $this->request->set("slug", $this->toSlug($this->request));
        $tableName = (new Product())->getTable();

        if ($id = $this->segment(3)) {
            $name = ['required', 'min:3', 'max:45', 'unique:'.$tableName.',name,'.$id];
            $slug = ['required', 'min:3', 'max:100', 'alpha_dash', 'unique:'.$tableName.',slug,'.$id];
            $code = ['nullable', 'min:3', 'max:45', 'unique:'.$tableName.',code,'.$id];
            $barcode = ['nullable', 'min:3', 'max:45', 'unique:'.$tableName.',barcode,'.$id];
        } else {
            $name = ['required', 'min:3', 'max:45', 'unique:'.$tableName.',name'];
            $slug = ['required', 'min:3', 'max:100', 'alpha_dash', 'unique:'.$tableName.',slug'];
            $code = ['nullable', 'min:3', 'max:45', 'unique:'.$tableName.',code'];
            $barcode = ['nullable', 'min:3', 'max:45', 'unique:'.$tableName.',barcode'];
        }

        return [
            'name' => $name,
            'code' => $code,
            'barcode' => $barcode,
            'slug' => $slug,
            'category_id' => 'required|numeric',
            'regular_price' => 'required|numeric',
            'special_price' => 'nullable|numeric',
            'description' => 'nullable|max:255'
        ];
    }

    protected function toSlug($request)
    {
        $value = !empty($request->get('slug')) ? $request->get('slug') : $request->get('name');
//        $slug = strtolower(preg_replace('/[\s-_|=+@#$%^&*]/', '-', $value));
        $slug = Str::slug($value);
        return $slug;
    }
}
