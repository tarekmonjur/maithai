<?php

namespace App\Http\Services;

use App\Models\Category;

trait CategoryService
{

    private $columns = [
        'sl' => 100,
        'name' => 0,
        'slug' => 0,
        'status' => 0,
        'created' => 0,
        'updated' => 0,
        'action' => 100,
    ];

    protected function getColumns()
    {
        $columns = [];
        foreach ($this->columns as $key => $value) {
            $columns[$key]['name'] = trans('backend/category.'.$key);
            $columns[$key]['width'] = $value;
        }
        return $columns;
    }

    protected function getData()
    {
//        dd(Category::with('subCategories')->inRandomOrder()->first());
        $categories = Category::withCount(['subCategories', 'products'])
            ->with(['subCategories']);
        if (config('app.backend_is_paginate')) {
            $categories = $categories->paginate(config('app.backend_per_page'));
        } else {
            $categories = $categories->get();
        }
        return $categories;
    }

    protected function getDataModel()
    {
        $data['title'] = trans('backend/category.title');
        $data['results'] = $this->getData()->toArray();
        $data['columns'] = $this->getColumns();
        dd($data);
        return $data;
    }

}
