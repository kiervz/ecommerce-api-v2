<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductCollection;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(30);

        return $this->customResponse('results', new ProductCollection($products));
    }

    public function show(Product $product)
    {
        return $this->customResponse('Product fetch successfully!', $product);
    }
}
