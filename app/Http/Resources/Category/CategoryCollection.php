<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryCollection extends ResourceCollection
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
                    'user' => $request->user->username,
                    'segment' => $request->segment->name,
                    'name' => $request->name
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
