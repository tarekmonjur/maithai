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

    public function getImageAttribute($value) {
        if (!empty($value)) {
            $upload_path = config('app.asset_path')."category/";
            return "{$upload_path}{$value}";
        }
        return $value;
    }

    public function createdBy() {
        return $this->belongsTo(User::class, 'created_by', 'id')
            ->with('details');
    }

    public function updatedBy() {
        return $this->belongsTo(User::class, 'updated_by', 'id')
            ->with('details');
    }
}
