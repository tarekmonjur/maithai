<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function subCategory() {
        return $this->hasMany(SubCategory::class, 'category_id', 'id');
    }

    public function product() {
        return $this->belongsTo(Product::class, 'id', 'category_id');
    }
}
