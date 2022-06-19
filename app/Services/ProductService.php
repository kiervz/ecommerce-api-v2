<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

use Auth;

class ProductService
{
    public function showProducts($sort, $search)
    {
        $search_products = Product::where(function($query) use ($search) {
            $query->where('slug', 'LIKE', "%$search%")
                ->orWhere('name', 'LIKE', "%$search%")
                ->orWhere('sku', 'LIKE', "%$search%");
            })->where('deleted_at', null);

        if ($sort === 'latest') {
            $search_products->orderBy('created_at', 'DESC');
        } else if ($sort === 'lowest-price') {
            $search_products->orderBy('actual_price', 'ASC');
        } else if ($sort === 'highest-price') {
            $search_products->orderBy('actual_price', 'DESC');
        }

        return $search_products->paginate(30);
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

            $new_img_name = Auth::id() . rand(0, 100) . time() . '.' . $extension;

            $old_img_name = Storage::disk('public')->put('/', $item);

            Storage::move('public/'.$old_img_name, $new_img_name);

            $product->productImages()->create([
                'name' => $new_img_name
            ]);
        }
    }
}
