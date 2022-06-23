<?php

namespace App\Services;

use App\Models\Cart;

class CartService
{
    public function createCart($request)
    {
        $cart = $request->user()->carts()->where('store_id', $request->store_id)->first();

        if ($cart) {
            $cart_item = $cart->cartItems()->where('product_id', $request->product_id)->first();

            if ($cart_item) {
                $cart_item->update([
                    'qty' => ($cart_item->qty + $request->qty)
                ]);
            } else {
                $cart->cartItems()->create($request->validated());
            }

            return $cart;
        } else {
            $cart = $request->user()->carts()->create($request->validated());
            $cart->cartItems()->create($request->validated());

            return $cart;
        }

    }
}
