<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }
}
