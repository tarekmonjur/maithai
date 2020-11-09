<?php

namespace App\Http\Services;

use App\Models\Category;

trait CategoryService
{

    private $columns = [
        'sl', 'name', 'slug', 'status', 'created', 'updated', 'action',
    ];

    protected function getColumns()
    {
        $columns = [];
        foreach ($this->columns as $value) {
            $columns[$value] = trans('backend/category.'.$value);
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
