<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

use Auth;

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

        foreach ($request['product_images'] as $item) {
            $extension = $item->getClientOriginalExtension();

            $new_img_name = Auth::id() . rand(0, 100) . time() . '.' . $extension;

            $old_img_name = Storage::disk('public')->put('/', $item);

            Storage::move('public/'.$old_img_name, $new_img_name);

            $product->productImages()->create([
                'name' => $new_img_name
            ]);
        }

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
