<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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

    public function store(ProductStoreRequest $request)
    {
        $product = Product::create($request->validated());

        return $this->customResponse('Product created successfully!', new ProductResource($product), Response::HTTP_CREATED);
    }
}
