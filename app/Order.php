<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['order_id', 'user_id','guest_token', 'status'];

    const PENDING = '0';

    const COMPLETE = '1';

    public function user(){
        return $this->belongsTo(User::class);
    }
}
