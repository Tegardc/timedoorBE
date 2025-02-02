<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    use HasFactory;

    protected $fillable = ['brands_name'];

    public function products()
    {
        return $this->hasMany(Products::class, 'brands_id');
    }
}
