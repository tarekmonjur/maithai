<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    public function variantTypes() {
        return $this->hasMany(VariantType::class, 'variant_id', 'id');
    }
}
