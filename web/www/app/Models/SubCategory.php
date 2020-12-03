<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    public function products() {
        return $this->hasMany(Product::class, 'sub_category_id', 'id');
    }
}
