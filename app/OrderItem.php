<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'product_id','quantity', 'price'];

    public $timestamps = false;

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function product(){
        return $this->hasOne(Product::class);
    }
}
