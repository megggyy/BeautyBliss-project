<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $table = 'reviews';
    protected $primaryKey = 'review_id';
    protected $fillable = [
        'review_id',
        'comment',
        'rate',
        'product_id',
        'product_images_id',
        'user_id',
    ];
    public function product()
    {
       return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function product_images()
    {
       return $this->hasmany(ProductImage::class, 'id', 'id');
    }

    public function user()
    {
       return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function customer()
    {
       return $this->belongsTo(User::class, 'customer_id', 'id');
    }
}

