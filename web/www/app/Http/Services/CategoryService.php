<?php

namespace App\Http\Services;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;

trait CategoryService
{

    public function getData() {
        $categories = Category::withCount(['subCategory', 'product'])->with('subCategory', 'product')->get();
        $results = $categories;
        return $results;
    }

    public function getDataModel() {
        $data['title'] = trans('backend/category.title');
        $data['categories'] = $this->getData();
        return $data;
    }

}