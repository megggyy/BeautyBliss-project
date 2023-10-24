<?php

namespace App\Models;

use App\Models\ProductColor;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Searchable;

    protected $table = 'products';
    protected $fillable = [
        'category_id',
        'name',
        'slug', 
        'brand',
        'small_description',
        'description',
        'original_price',
        'selling_price',
        'quantity',
        'trending',
    ];

    public function reviews()
    {
    return $this->hasMany(Review::class);
    }

    public function category()
    {
       return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function productColors()
    {
        return $this->hasMany(ProductColor::class, 'product_id', 'id');
    }

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
            'small_description' => $this->small_description,
            'brand' => $this->brand,
            'description' => $this->description,
            'selling_price' => $this->selling_price,
        ];
    }
    
}
