<?php

namespace App\Services;

use App\Models\Product;

use Illuminate\Support\Facades\Storage;
use Auth;
use Image;

class ProductService
{

    public function showAllProducts($sort, $search)
    {
        $searchProducts = Product::where(function($query) use ($search) {
            $query->where('slug', 'LIKE', "%$search%")
                ->orWhere('name', 'LIKE', "%$search%")
                ->orWhere('sku', 'LIKE', "%$search%");
            })->where('deleted_at', null);

        if ($sort === 'latest') {
            $searchProducts->orderBy('created_at', 'DESC');
        } else if ($sort === 'lowest-price') {
            $searchProducts->orderBy('actual_price', 'ASC');
        } else if ($sort === 'highest-price') {
            $searchProducts->orderBy('actual_price', 'DESC');
        }

        return $searchProducts->paginate(30);
    }

    public function createProduct($request)
    {
        $product = Product::create($request->validated());

        $this->createProductImages($product, $request['product_images']);

        return $product;
    }

    private function createProductImages($product, $product_images)
    {
        foreach ($product_images as $item) {
            $extension = $item->getClientOriginalExtension();

            $photo_name = Auth::id() . rand(0, 100) . time() . '.' . $extension;

            $img = Image::make($item);

            Storage::disk('s3')->put('images/'.$photo_name, $img->stream());

            Storage::disk('s3')->setVisibility('images/'.$photo_name, 'public');

            $file_url = Storage::disk('s3')->url('images/'.$photo_name);

            $product->productImages()->create(['name' => $photo_name, 'url' => $file_url]);
        }
    }
}
