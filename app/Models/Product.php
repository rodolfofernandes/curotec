<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    protected $fillable = [
        'name',
        'color',
        'description',
        'price',
        'stock',
        'sku',
    ];

    protected $appends = ['category'];
    
   public function scopeName($query, $name)
    {
        return $query->where('name', 'like', '%' . $name . '%');
    }


    public function scopeColor($query, $color)
    {
        return $query->where('color', '=', $color);
    }

 
    public function scopePriceMin($query, $priceMin)
    {
        return $query->where('price', '>=', $priceMin);
    }

  
    public function scopeCategory($query, $categoryId)
    {
        return $query->whereHas('categories', function ($q) use ($categoryId) {
            $q->where('categories.id', $categoryId);
        });
    }

      public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }


    public function getCategoryAttribute()
    {
        return $this->categories->first();
    }

    protected static function booted()
{
    static::creating(function ($product) {
        // Generate a unique SKU: e.g., PROD-YYYYMMDDHHMMSS-<random>
        $product->sku = 'PROD-' . now()->format('YmdHis') . '-' . strtoupper(substr(uniqid(), -5));
    });
}
}
