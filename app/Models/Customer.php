<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'customers';
    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'pin_code',
        'address',
        'images', // Add the images attribute to the fillable array
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'images' => 'array',
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getImageUrlAttribute()
    {
        // Assuming your 'images' column stores the image paths, modify the path accordingly
        return asset('storage/' . $this->images[0]);
    }
}

