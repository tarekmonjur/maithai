<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    public function createdBy() {
        return $this->belongsTo(User::class, 'created_by', 'id')
            ->with('details');
    }

    public function updatedBy() {
        return $this->belongsTo(User::class, 'updated_by', 'id')
            ->with('details');
    }
}
