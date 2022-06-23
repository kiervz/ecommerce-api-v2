<?php

namespace App\Http\Resources\Cart;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            'store' => $this->store->name,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'items' => CartItemResource::collection($this->cartItems)
        ];
    }
}
