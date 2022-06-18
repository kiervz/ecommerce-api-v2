<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->authUser();
    }

    public function test_can_fetch_all_products()
    {
        $this->createProducts(10);
        $this->get(route('product.index'))->assertSuccessful();

        $this->assertDatabaseCount('products', 10);
    }
}
