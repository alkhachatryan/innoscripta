<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'setHeaders'], function (){
    Route::group(['prefix' => 'products', 'namespace' => 'Products', 'as' => 'products.'], function (){
        Route::get('/', ['as' => 'index', 'uses' => 'ProductsResourceController@index']);
        Route::get('/{slug}', ['as' => 'single', 'uses' => 'ProductsResourceController@single']);
    });

    Route::group(['prefix' => 'cart', 'namespace' => 'Cart', 'as' => 'cart.'], function (){
        Route::post('/update', ['as' => 'add_update', 'uses' => 'CartController@updateOrCreateCartItem']);
        Route::delete('/delete', ['as' => 'delete', 'uses' => 'CartController@removeCartItem']);
    });
});
