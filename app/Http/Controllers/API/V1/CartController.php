<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Cart\CartResource;
use Illuminate\Http\Request;

use Auth;

class CartController extends Controller
{
    public function index()
    {
        $carts = Auth::user()->carts;

        return $this->customResponse('fetched all carts', CartResource::collection($carts));
    }
}
