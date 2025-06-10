<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    
    public function categoryProducts()
    {
        return $this->hasMany(CategoryProduct::class);
    }
}
