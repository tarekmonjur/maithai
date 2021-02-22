<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    protected $guarded = [];

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

    public function type() {
        return $this->belongsTo(UserType::class, 'user_type_id', 'id');
    }

    public function service() {
        return $this->belongsTo(UserServiceType::class, 'user_service_type_id', 'id');
    }

    public function status() {
        return $this->belongsTo(UserStatus::class, 'user_status_id', 'id');
    }
}
