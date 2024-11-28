<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'price', 'quantity', 'category_id', 'brands_id'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function brands()
    {
        return $this->belongsTo(Brands::class, 'brands_id');
    }
    // protected $visible = ['id', 'name', 'price', 'quantity', 'category_id', 'brands_id'];
}
