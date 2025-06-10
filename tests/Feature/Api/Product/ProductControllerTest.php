<?php

namespace Tests\Feature;

use Tests\TestCase;
use Mockery;
use App\Services\ProductService;
use Illuminate\Support\Facades\App;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductControllerTest extends TestCase
{
    public function test_returns_paginated_list_of_products_with_all_fields()
    {
        // Mock ProductService
        $mock = Mockery::mock(ProductService::class);

        // All fields from your Product model
        $productFields = [
            'id' => 1,
            'name' => 'Product A',
            'price' => 100,
            'color' => 'red',
            'description' => 'Product A description',
            'created_at' => now()->toISOString(),
            'updated_at' => now()->toISOString(),
        ];

        $productFields2 = [
            'id' => 2,
            'name' => 'Product B',
            'price' => 200,
            'color' => 'blue',
            'description' => 'Product B description',
            'created_at' => now()->toISOString(),
            'updated_at' => now()->toISOString(),
        ];

        // Fake pagination
        $fakePagination = new LengthAwarePaginator(
            collect([$productFields, $productFields2]),
            2,      // total
            10,     // perPage
            1       // currentPage
        );

        $mock->shouldReceive('getProducts')
            ->once()
            ->andReturn($fakePagination);

        App::instance(ProductService::class, $mock);

        $response = $this->getJson('/api/products');

        // Check if all fields exist in the response
        $response->assertOk()
            ->assertJsonCount(2, 'data')
            ->assertJsonFragment($productFields)
            ->assertJsonFragment($productFields2)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'price',
                        'color',
                        'description',
                        'created_at',
                        'updated_at',
                    ]
                ]
            ]);
    }

    public function test_returns_empty_list_when_no_products_exist()
    {
        $mock = Mockery::mock(ProductService::class);

        $fakePagination = new \Illuminate\Pagination\LengthAwarePaginator(
            collect([]),
            0, // total
            10, // perPage
            1   // currentPage
        );

        $mock->shouldReceive('getProducts')
            ->once()
            ->andReturn($fakePagination);

        App::instance(ProductService::class, $mock);

        $response = $this->getJson('/api/products');

        $response->assertOk()
            ->assertJsonCount(0, 'data')
            ->assertJsonStructure([
                'data',
            ]);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}