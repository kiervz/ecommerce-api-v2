<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductCollection;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function showAllProducts(Request $request)
    {
        $sort = $request->get('sort');
        $search = $request->get('q');

        $products = $this->productService->showAllProducts($sort, $search);

        return $this->customResponse('results', new ProductCollection($products));
    }
}
