<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

class CartController extends Controller
{
    public function index()
    {
        $carts = Auth::user()->carts;

        return $this->customResponse('fetched all carts', $carts);
    }
}
