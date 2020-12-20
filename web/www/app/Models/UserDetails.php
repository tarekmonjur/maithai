<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{

    public function getFullNameAttribute() {
        return ucfirst($this->first_name). ' '.ucfirst($this->last_name);
    }

    public function getPhotoAttribute($value) {
        if (!empty($value)) {
            $upload_path = config('app.asset_path')."user/";
            return "{$upload_path}{$value}";
        }
        return $value;
    }
}
