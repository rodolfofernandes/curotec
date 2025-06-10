<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;

class CategoryProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryIds = Category::pluck('id')->toArray();
        $productIds = Product::pluck('id')->toArray();

        foreach ($productIds as $productId) {
            $categoryId = collect($categoryIds)->random();
            DB::table('category_product')->insert([
                'category_id' => $categoryId,
                'product_id' => $productId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
