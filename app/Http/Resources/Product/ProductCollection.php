<?php

namespace App\Http\Resources\Product;

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
                    'seller' => $request->seller,
                    'brand' => $request->brand->name,
                    'segment' => $request->segment->name,
                    'category' => $request->category->name,
                    'subCategory' => $request->subCategory->name,
                    'sku' => $request->sku,
                    'name' => $request->name,
                    'unit_price' => number_format($request->unit_price, 2),
                    'discount' => number_format($request->discount, 2),
                    'actual_price' => number_format($request->actual_price, 2),
                    'stock' => $request->stock,
                    'description' => $request->description,
                    'productImages' => $request->productImages
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
