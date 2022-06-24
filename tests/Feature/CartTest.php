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

    public function test_can_store_cart()
    {
        $this->post(route('cart.store'), [
            'store_id' => $this->createStore()->id,
            'product_id' => $this->createProduct()->id,
            'qty' => 2
        ])->assertCreated();

        $this->assertDatabaseCount('carts', 2);
        $this->assertDatabaseCount('cart_items', 3);
    }

    public function test_can_update_specific_cart_item()
    {
        $this->put(route('cart-item.update', $this->cart->cartItems[0]), [
            'cart_item_id' => $this->cart->cartItems[0]->id,
            'qty' => 33
        ])->assertOk();

        $this->assertDatabaseHas('cart_items', ['qty' => 33]);
    }
}
