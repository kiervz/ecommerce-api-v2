<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    protected $fillable = [
        "seller_id",
        "brand_id",
        "segment_id",
        "category_id",
        "sub_category_id",
        "sku",
        "name",
        "slug",
        "unit_price",
        "discount",
        "actual_price",
        "stock",
        "description"
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
