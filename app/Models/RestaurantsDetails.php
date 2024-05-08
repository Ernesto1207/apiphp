<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantsDetails extends Model
{
    use HasFactory;

    protected $table = 'restaurants_details';

    protected $fillable = [
        'restaurants_id',
        'first_name',
        'last_name',
        'phone_number',
        'district',
        'province',
        'department',
    ];

    public function restaurant()
    {
        return $this->belongsTo(RestaurantsUser::class, 'restaurants_id');
    }
}
