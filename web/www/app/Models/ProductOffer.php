<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductOffer extends Model
{
    public function offer() {
        return $this->belongsTo(Offer::class, 'offer_id', 'id');
    }
}
