<?php
namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductService
{
    public function getProducts(Request $request)
    {
        $query = Product::query();

      if ($request->filled('name')) {
            $query->name($request->query('name'));
        }

        if ($request->filled('color')) {
            $query->color($request->query('color'));
        }

        if ($request->filled('price_min')) {
            $query->priceMin($request->query('price_min'));
        }

        if ($request->filled('category_id')) {
            $query->category($request->query('category_id'));
        }

        $perPage = $request->query('per_page', 10);

        return $query->paginate($perPage);
    }
}