<?php
/**
 * CategoryService
 * @author : Tarek Monjur
 * @email : tarekmonjur@gmail.com
 */

namespace App\Http\Services;

use App\Models\Category;

trait CategoryService
{
    use CommonService;

    private $trans_prefix = 'category.';
    private $trans_key = 'list';
    private $columns = [
        'sl' => 100,
        'name' => 0,
        'products_count' => 0,
        'slug' => 0,
        'is_active' => 0,
        'created' => 0,
        'updated' => 0,
        'action' => 100,
    ];
    private $data = [];

    protected function initData()
    {
        $this->setTitle();
        $this->setColumns();
        return $this;
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
        $results = $this->getData()->toArray();
        if (config('app.backend_is_paginate')) {
            foreach($results as $key => $result) {
                if ($key !== 'data') {
                    $this->data[$key] = $results[$key];
                }
            }
            $this->data['results'] = $results['data'];
        } else {
            $this->data['results'] = $results;
        }

        return $this->data;
    }

}
