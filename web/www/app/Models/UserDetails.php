<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{

    public function getFullNameAttribute() {
        return ucfirst($this->first_name). ' '.ucfirst($this->last_name);
    }
}
