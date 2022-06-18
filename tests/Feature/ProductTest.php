<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    private $product;

    public function setUp(): void
    {
        parent::setUp();
        $this->authUser();
        $this->product = $this->createProduct();
    }

    public function test_can_fetch_all_products()
    {
        $this->createProducts(10);
        $this->get(route('product.index'))->assertSuccessful();

        $this->assertDatabaseCount('products', 10);
    }

    public function test_fetch_specific_product()
    {
        $this->get(route('product.show', $this->product))
            ->assertSuccessful();
    }

    public function test_create_product()
    {
        $this->post(route('product.store'), [
            "sku" => "4B8BDSH1259CFD12",
            "name" => "New Balance 411 V2 Performance Shoes",
            "unit_price" => 3425.00,
            "discount" => 0,
            "actual_price" => 3425.00,
            "stock" => 100,
            "description" => "Sample Descriptio",
            "seller_id" => 1,
            "brand_id" => 1,
            "segment_id" => 2,
            "category_id" => 2,
            "sub_category_id" => 1
        ])->assertCreated();

        $this->assertDatabaseHas('products', ['name' => 'New Balance 411 V2 Performance Shoes']);
    }
}
