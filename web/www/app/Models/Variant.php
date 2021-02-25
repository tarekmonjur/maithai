<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    public function getImageAttribute($value) {
        if (!empty($value)) {
            $upload_path = config('app.asset_path')."variant/";
            return "{$upload_path}{$value}";
        }
        return $value;
    }

    public function subVariants() {
        return $this->hasMany(SubVariant::class, 'variant_id', 'id');
    }

    public function productVariants() {
        return $this->hasMany(ProductVariant::class, 'variant_id', 'id')
            ->with('product');
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
