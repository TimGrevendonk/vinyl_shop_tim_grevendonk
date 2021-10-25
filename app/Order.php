<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user() {
        // an order only belongs to 1 user
        return $this->belongsTo('App\User')->withDefault();   // an order belongs to a user
    }

    public function orderlines() {
        // but an order can have many orderlines (products)
        return $this->hasMany('App\Orderline');   // an order has many orderlines
    }
}
