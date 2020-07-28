<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id', 'guest_token'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
