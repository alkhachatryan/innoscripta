<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = ['cart_id','product_id','quantity'];
    const UPDATED_AT = null;
    const CREATED_AT = 'added_at';
    const NOT_FOUND = 'Not found';

    public function cart(){
        return $this->belongsTo(Cart::class);
    }

    public function product(){
        return $this->hasOne(Product::class);
    }
}
