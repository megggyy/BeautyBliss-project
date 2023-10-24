<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'images',
        'status',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    protected $dates = ['deleted_at'];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function brands()
    {
        return $this->hasMany(Brand::class, 'category_id', 'id')->where('status','0');
    }

}
