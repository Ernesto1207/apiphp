<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $table = 'UserDetails';
    
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'phone_number',
        'district',
        'province',
        'department',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
