<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Store extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    protected $fillable = [
        'seller_id',
        'name',
        'slug',
        'bio',
        'last_log',
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

    public function seller()
    {
        return $this->hasOne(Seller::class, 'id', 'seller_id');
    }
}
