<?php

namespace App\Http\Services;

use App\Models\Category;

trait CategoryService
{
    private $title;
    private $columns = [
        'sl' => 100,
        'name' => 0,
        'slug' => 0,
        'status' => 0,
        'created' => 0,
        'updated' => 0,
        'action' => 100,
    ];
    private $data = [];

    protected function setTitle($key)
    {
        $this->title = $key;
        return $this;
    }

    protected function getTitle($key = null)
    {
        $key = $key ?? $this->title;
        $title = trans('backend/category.'.$key);
        $this->data['title'] = $title;
        return $title;
    }

    protected function init()
    {
        $this->getTitle();
        $this->getColumns();
        return $this->data;
    }

    protected function getColumns()
    {
        $columns = [];
        foreach ($this->columns as $key => $value) {
            $columns[$key]['name'] = trans('backend/category.'.$key);
            $columns[$key]['width'] = $value;
        }
        $this->data['columns'] = $columns;
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
        $this->init();
        $this->data['results'] = $this->getData()->toArray();
        return $this->data;
    }

}
