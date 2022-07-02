<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\ProductImage\ProductImageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'sku' => $this->sku,
            'name' => $this->name,
            'slug' => $this->slug,
            'unit_price' => number_format($this->unit_price, 2),
            'discount' => number_format($this->discount, 2),
            'actual_price' => number_format($this->actual_price, 2),
            'stock' => $this->stock,
            'description' => $this->description,
            'productImages' => ProductImageResource::collection($this->productImages),
            'seller' => [
                'id' => $this->seller->id,
                'name' => $this->seller->firstname . ' ' . $this->seller->lastname
            ],
            'brand' => [
                'id' => $this->brand->id,
                'name' => $this->brand->name
            ],
            'segment' => [
                'id' => $this->segment->id,
                'name' => $this->segment->name
            ],
            'category' => [
                'id' => $this->category->id,
                'name' => $this->category->name
            ],
            'subCategory' => [
                'id' => $this->subCategory->id,
                'name' => $this->subCategory->name
            ],
        ];
    }
}
