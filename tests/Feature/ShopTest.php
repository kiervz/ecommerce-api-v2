<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShopTest extends TestCase
{
    use RefreshDatabase;

    public function test_fetch_all_products_shop()
    {
        $this->createProducts(10);
        $this->get(route('shop.showAllProducts'))->assertSuccessful();

        $this->assertDatabaseCount('products', 10);
    }

    public function test_fetch_product()
    {
        $product = $this->createProduct();

        $this->get(route('shop.showProduct', ['product' => $product['slug']]))
            ->assertSuccessful();
    }
}
