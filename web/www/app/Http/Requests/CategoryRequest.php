<?php

namespace App\Http\Requests;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CategoryRequest extends FormRequest
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
        $this->request->set("slug", $this->toSlug($this->request->get('name')));
        $tableName = (new Category())->getTable();

        if ($id = $this->segment(3)) {
            $name = ['required', 'min:3', 'max:45', 'unique:'.$tableName.',name,'.$id];
            $slug = ['required', 'min:3', 'max:100', 'alpha_dash', 'unique:'.$tableName.',slug,'.$id];
        } else {
            $name = ['required', 'min:3', 'max:45', 'unique:'.$tableName.',name'];
            $slug = ['required', 'min:3', 'max:100', 'alpha_dash', 'unique:'.$tableName.',slug'];
        }

        return [
            'name' => $name,
            'slug' => $slug,
            'description' => 'nullable|max:255'
        ];
    }

    private function toSlug($value)
    {
//        $slug = strtolower(preg_replace('/[\s-_|=+@#$%^&*]/', '-', $value));
        $slug = Str::slug($value);
        return $slug;
    }
}
