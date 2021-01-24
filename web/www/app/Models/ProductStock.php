<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    public function product() {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function sku() {
        return $this->belongsTo(Sku::class, 'sku_id', 'id');
    }
}
