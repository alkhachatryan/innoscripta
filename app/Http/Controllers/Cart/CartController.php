<?php

namespace App\Http\Controllers\Cart;

use App\Cart;
use App\CartItem;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\AddToCartRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(AddToCartRequest $request){
        if(Auth::guard('api')->check()){
            $userIdentifierColumnName = 'user_id';
            $userIdentifierValue = Auth::guard('api')->id;
        }
        else {
            if(! $request->filled('guest_token'))
                return response()->json('Unauthorized', 401);

            $userIdentifierColumnName = 'guest_token';
            $userIdentifierValue = $request->input('guest_token');
        }

        $cart = Cart::firstOrCreate([ $userIdentifierColumnName => $userIdentifierValue ]);

        $cartItem = CartItem::firstOrNew([
           'cart_id' => $cart->id,
            'product_id' => $request->input('product_id')
        ]);

        $cartItem->quantity += $request->input('quantity');
        $cartItem->save();

        return response()->json(Cart::ADDED_TO_CART, 201);
    }

    public function updateCart(){

    }
}
