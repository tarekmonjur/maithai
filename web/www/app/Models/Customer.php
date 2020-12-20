<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'access_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    protected $guarded = [
        'password'
    ];

    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }

    public function details() {
        return $this->hasOne(CustomerDetails::class, 'customer_id', 'id');
    }

    public function createdBy() {
        return $this->belongsTo(User::class, 'created_by', 'id')
            ->with('details');
    }

    public function updatedBy() {
        return $this->belongsTo(User::class, 'updated_by', 'id')
            ->with('details');
    }
}
