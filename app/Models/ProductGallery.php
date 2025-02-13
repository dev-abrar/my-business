<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGallery extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Optionally, if your column name is 'gallery' and you want to access the file path easily:
    public function getGalleryUrlAttribute()
    {
        return url('upload/product/gallery/' . $this->gallery);
    }
}
