<?php

namespace App\Http\Controllers\Cart;

use App\Cart;
use App\CartItem;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\RemoveCartItemRequest;
use App\Http\Requests\Cart\UpdateCartRequest;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    private function getCustomerIdentification($request){
        $userIdentifier = new \stdClass();

        if(Auth::guard('api')->check()){
            $userIdentifier->columnName = 'user_id';
            $userIdentifier->value = Auth::guard('api')->id;
        }
        else {
            if(! $request->filled('guest_token'))
                return false;

            $userIdentifier->columnName = 'guest_token';
            $userIdentifier->value = $request->input('guest_token');
        }

        return $userIdentifier;
    }

    public function updateOrCreateCartItem(UpdateCartRequest $request){
        if(! $userIdentifier = $this->getCustomerIdentification($request))
            return response()->json('Unauthorized', 401);

        $cart = Cart::firstOrCreate([ $userIdentifier->columnName => $userIdentifier->value ]);

        $cartItem = CartItem::firstOrNew([
            'cart_id' => $cart->id,
            'product_id' => $request->input('product_id')
        ]);

        $cartItem->quantity += $request->input('quantity');
        $cartItem->save();

        if(! $cartItem)
            return response()->json(CartItem::NOT_FOUND, 404);

        $cartItem->quantity += $request->input('quantity');
        $cartItem->save();

        return response()->json(Cart::SUCCESS, 200);
    }

    public function removeCartItem(RemoveCartItemRequest $request){
        if(! $userIdentifier = $this->getCustomerIdentification($request))
            return response()->json('Unauthorized', 401);

        $cartItem = CartItem::whereHas('cart', function ($query) use($userIdentifier){
            $query->where($userIdentifier->columnName, $userIdentifier->value);
        })
            ->whereProductId($request->input('product_id'))
            ->delete();

        if(! $cartItem)
            return response()->json(Cart::NOT_FOUND, 404);

        return response()->json(Cart::SUCCESS, 200);
    }
}
