<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\CartItemUpdateRequest;
use App\Http\Requests\Cart\CartStoreRequest;
use App\Http\Resources\Cart\CartResource;
use App\Models\Cart;
use App\Models\CartItem;
use App\Services\CartService;
use Illuminate\Http\Request;

use Auth;
use Illuminate\Http\Response;

class CartController extends Controller
{
    protected $cart_service;

    public function __construct(CartService $cart_service)
    {
        $this->cart_service = $cart_service;
    }

    public function index()
    {
        $carts = Auth::user()->carts;

        return $this->customResponse('fetched all carts', CartResource::collection($carts));
    }

    public function store(CartStoreRequest $request)
    {
        $cart = $this->cart_service->createCart($request);

        return $this->customResponse('created cart successfully!', new CartResource($cart), Response::HTTP_CREATED);
    }

    public function updateCartItem(CartItemUpdateRequest $request)
    {
        $cart_item = $this->cart_service->updateCartItem($request);

        if (!$cart_item) {
            return $this->customResponse('no cart item found!', [], Response::HTTP_NOT_FOUND, false);
        }

        return $this->customResponse('updated cart successfully!', $cart_item, Response::HTTP_OK);
    }

    public function deleteCartItem(Request $request)
    {
        $this->cart_service->deleteCartItem($request);

        return $this->customResponse('deleted cart item successfully!', [], Response::HTTP_NO_CONTENT);
    }
}
