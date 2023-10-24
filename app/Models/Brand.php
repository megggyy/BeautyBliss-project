<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Livewire\WithFileUploads; // Import the WithFileUploads trait

class Brand extends Model
{
    use HasFactory;
    use SoftDeletes;
    use WithFileUploads; // Use the WithFileUploads trait

    protected $table = 'brands';
    protected $fillable = [
        'name',
        'slug',
        'status',
        'category_id',
        'images'
    ];

    protected $dates = ['deleted_at'];

    protected $casts = [
        'images' => 'array', // Cast the 'images' attribute as an array
        'status' => 'boolean', 
    ];
    
    public function getImageUrlAttribute()
    {
        // Assuming your 'images' column stores the image paths, modify the path accordingly
        return asset('storage/' . $this->images[0]);
    }


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
