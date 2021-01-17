<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function getImageAttribute($value) {
        if (!empty($value)) {
            $upload_path = config('app.asset_path')."product/";
            return "{$upload_path}{$value}";
        }
        return $value;
    }

    public function offer() {
        $offer_table = (new Offer)->getTable();
        $product_offer_table = (new ProductOffer)->getTable();

        return $this->hasOne(ProductOffer::class, 'product_id', 'id')
            ->join($offer_table, $offer_table.'.id', '=', $product_offer_table.'.offer_id')
            ->where('is_active', 1);

    }

    public function brand() {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function category() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function subCategory() {
        return $this->belongsTo(SubCategory::class, 'sub_category_id', 'id');
    }

    public function unit() {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }

    public function variants() {
        return $this->hasMany(ProductVariant::class, 'product_id', 'id')
            ->with(['variant', 'subVariant']);
    }

    public function stocks() {
        return $this->hasMany(ProductStock::class, 'product_id', 'id')
            ->with(['sku']);
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
