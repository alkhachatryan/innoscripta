<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    const NOT_FOUND = 'Not found';

    protected $fillable = ['title', 'slug','thumbnail', 'images', 'description', 'price'];
}
