<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function subCategories() {
        return $this->hasMany(SubCategory::class, 'category_id', 'id')
            ->withCount('products');
    }

    public function products() {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
