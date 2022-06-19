<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $sort = $request->get('sort');
        $search = $request->get('q');

        $products = $this->productService->showProducts($sort, $search);

        return $this->customResponse('results', new ProductCollection($products));
    }

    public function show(Product $product)
    {
        return $this->customResponse('Product fetch successfully!', $product);
    }

    public function store(ProductStoreRequest $request)
    {
        $product = $this->productService->createProduct($request);

        return $this->customResponse('Product created successfully!', new ProductResource($product), Response::HTTP_CREATED);
    }

    public function update(Product $product, ProductUpdateRequest $request)
    {
        $product->update($request->validated());

        return $this->customResponse('Product updated successfully!', new ProductResource($product), Response::HTTP_OK);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return $this->customResponse('Product deleted successfully!', [], Response::HTTP_NO_CONTENT);
    }
}
