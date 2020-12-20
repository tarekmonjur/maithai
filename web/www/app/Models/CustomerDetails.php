<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerDetails extends Model
{
    public function getFullNameAttribute() {
        return ucfirst($this->first_name). ' '.ucfirst($this->last_name);
    }

    public function getPhotoAttribute($value) {
        if (!empty($value)) {
            $upload_path = config('app.asset_path')."customer/";
            return "{$upload_path}{$value}";
        }
        return $value;
    }
}
