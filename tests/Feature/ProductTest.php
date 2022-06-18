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
}
