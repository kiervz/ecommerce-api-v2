<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\ProductImage\ProductImageResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function($request) {
                return [
                    'id' => $request->id,
                    'sku' => $request->sku,
                    'name' => $request->name,
                    'slug' => $request->slug,
                    'unit_price' => number_format($request->unit_price, 2),
                    'discount' => number_format($request->discount, 2),
                    'actual_price' => number_format($request->actual_price, 2),
                    'stock' => $request->stock,
                    'description' => $request->description,
                    'productImages' => ProductImageResource::collection($request->productImages),
                    'seller' => [
                        'id' => $request->seller->id,
                        'name' => $request->seller->firstname . ' ' . $request->seller->lastname
                    ],
                    'brand' => [
                        'id' => $request->brand->id,
                        'name' => $request->brand->name
                    ],
                    'segment' => [
                        'id' => $request->segment->id,
                        'name' => $request->segment->name
                    ],
                    'category' => [
                        'id' => $request->category->id,
                        'name' => $request->category->name
                    ],
                    'subCategory' => [
                        'id' => $request->subCategory->id,
                        'name' => $request->subCategory->name
                    ]
                ];
            }),
            'meta' => [
                'total' => $this->total(),
                'page' => $this->currentPage(),
                'perPage' => (int) $this->perPage(),
                'totalPages' => $this->lastPage(),
                'path' => $this->path()
            ]
        ];
    }
}
