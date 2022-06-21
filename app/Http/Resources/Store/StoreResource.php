<?php

namespace App\Http\Resources\Store;

use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
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
            'seller' => $this->seller->firstname . ' ' . $this->seller->lastname,
            'name' => $this->name,
            'slug' => $this->slug,
            'bio' => $this->bio,
            'last_log' => $this->last_log
        ];
    }
}
