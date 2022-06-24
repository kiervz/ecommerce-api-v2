<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;

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

    public function updateCartItem($request)
    {
        $cart_item = CartItem::where('id', $request['cart_item_id'])->first();

        if ($cart_item) {
            $cart_item->update(['qty' => $request['qty']]);
        }

        return $cart_item;
    }

    public function deleteCartitem($request)
    {
        if ($request['cart_id']) {
            $cart = Cart::where('id', $request['cart_id'])->first();
            $cart->cartItems->each->delete();
            $cart->delete();
        } else {
            $cart_items = CartItem::whereIn('id', $request['cart_item_id'])->get();
            $cart_items->each->delete();
        }
    }
}
