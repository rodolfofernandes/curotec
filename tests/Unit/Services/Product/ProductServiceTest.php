<?php
namespace Tests\Unit;

use Tests\TestCase;
use App\Services\ProductService;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_products_returns_paginated_products()
    {
        // Create products directly without factory
        for ($i = 1; $i <= 5; $i++) {
            Product::create([
                'name' => "Product $i",
                'color' => 'red',
                'price' => 100 * $i,
                'category_id' => 1,
                'stock' => 10 * $i,
            ]);
        }

        $service = new ProductService();
        $request = Request::create('/products', 'GET');

        $result = $service->getProducts($request);

        $this->assertInstanceOf(\Illuminate\Contracts\Pagination\LengthAwarePaginator::class, $result);
        $this->assertCount(5, $result->items());
        $this->assertEquals(10, $result->items()[0]->stock);
    }

    public function test_get_products_filters_by_name()
    {
        Product::create([
            'name' => 'TestProduct',
            'color' => 'red',
            'price' => 100,
            'category_id' => 1,
            'stock' => 5,
        ]);
        Product::create([
            'name' => 'OtherProduct',
            'color' => 'blue',
            'price' => 200,
            'category_id' => 2,
            'stock' => 8,
        ]);

        $service = new ProductService();
        $request = Request::create('/products?name=TestProduct', 'GET', ['name' => 'TestProduct']);

        $result = $service->getProducts($request);

        $this->assertCount(1, $result->items());
        $this->assertEquals('TestProduct', $result->items()[0]->name);
        $this->assertEquals(5, $result->items()[0]->stock);
    }

    public function test_get_products_filters_by_color()
    {
        Product::create([
            'name' => 'RedProduct',
            'color' => 'red',
            'price' => 100,
            'category_id' => 1,
            'stock' => 7,
        ]);
        Product::create([
            'name' => 'BlueProduct',
            'color' => 'blue',
            'price' => 200,
            'category_id' => 2,
            'stock' => 12,
        ]);

        $service = new ProductService();
        $request = Request::create('/products?color=red', 'GET', ['color' => 'red']);

        $result = $service->getProducts($request);

        $this->assertCount(1, $result->items());
        $this->assertEquals('red', $result->items()[0]->color);
        $this->assertEquals(7, $result->items()[0]->stock);
    }

    public function test_get_products_filters_by_price_min()
    {
        Product::create([
            'name' => 'CheapProduct',
            'color' => 'red',
            'price' => 50,
            'category_id' => 1,
            'stock' => 3,
        ]);
        Product::create([
            'name' => 'ExpensiveProduct',
            'color' => 'blue',
            'price' => 150,
            'category_id' => 2,
            'stock' => 9,
        ]);

        $service = new ProductService();
        $request = Request::create('/products?price_min=100', 'GET', ['price_min' => 100]);

        $result = $service->getProducts($request);

        $this->assertCount(1, $result->items());
        $this->assertGreaterThanOrEqual(100, $result->items()[0]->price);
        $this->assertEquals(9, $result->items()[0]->stock);
    }
}