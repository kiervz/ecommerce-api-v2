<?php

namespace App\Http\Resources\Product;

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
            'seller' => $this->seller,
            'brand' => $this->brand->name,
            'segment' => $this->segment->name,
            'category' => $this->category->name,
            'subCategory' => $this->subCategory->name,
            'sku' => $this->sku,
            'name' => $this->name,
            'slug' => $this->slug,
            'unit_price' => number_format($this->unit_price, 2),
            'discount' => number_format($this->discount, 2),
            'actual_price' => number_format($this->actual_price, 2),
            'stock' => $this->stock,
            'description' => $this->description,
            'productImages' => $this->productImages
        ];
    }
}
