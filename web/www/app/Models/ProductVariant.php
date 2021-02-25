<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    public function product() {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function variant() {
        return $this->belongsTo(Variant::class, 'variant_id', 'id');
    }

    public function subVariant() {
        return $this->belongsTo(SubVariant::class, 'sub_variant_id', 'id');
    }
}
