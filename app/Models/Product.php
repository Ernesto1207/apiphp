<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'category',
        'image',
        'stock',
        'restaurant_id',
    ];

    public function restaurant()
    {
        return $this->belongsTo(RestaurantsUser::class, 'restaurant_id');
    }
}
