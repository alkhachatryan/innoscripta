<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id', 'guest_token'];

    const SUCCESS = 'Success';
    const NOT_FOUND = 'Not found';

    public function user(){
        return $this->belongsTo(User::class);
    }
}
