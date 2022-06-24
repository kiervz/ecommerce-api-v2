<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\CartItemUpdateRequest;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CartItemController extends Controller
{
    public function update(CartItem $cart_item, CartItemUpdateRequest $request)
    {
        $cart_item->update($request->validated());

        return $this->customResponse('updated cart successfully!', [], Response::HTTP_OK);
    }
}
