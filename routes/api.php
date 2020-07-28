<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'setHeaders'], function (){
    Route::group(['prefix' => 'products', 'namespace' => 'Products', 'as' => 'products.'], function (){
        Route::get('/', ['as' => 'index', 'uses' => 'ProductsResourceController@index']);
    });
});
