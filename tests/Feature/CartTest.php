<?php

namespace Tests\Feature;

use App\Models\Cart;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    protected $cart;

    public function setUp(): void
    {
        parent::setUp();
        $this->authUser();
        $this->cart = $this->createCart();
    }

    public function test_can_fetch_all_carts()
    {
        $this->get(route('cart.index'))->assertSuccessful();

        $this->assertDatabaseCount('carts', 1);
    }
}
