<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = ['items', 'shipping_details'];

    public function orderDetails() {
        return $this->hasMany(OrderDetails::class, 'order_id', 'id');
    }

    public function shippingDetails() {
        return $this->hasOne(ShippingDetails::class, 'order_id', 'id');
    }

    public function customer() {
        return $this->belongsTo(Customer::class, 'customer_id', 'id')
            ->with('details');
    }

    public function table() {
        return $this->belongsTo(Table::class, 'table_id', 'id');
    }

    public function offer() {
        return $this->belongsTo(Offer::class, 'offer_id', 'id');
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
