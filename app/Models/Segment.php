<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Segment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "name"
    ];

    public function category()
    {
        return $this->hasOne(Category::class);
    }
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
