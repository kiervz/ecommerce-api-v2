<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartItemFactory extends Factory
{
    protected $model = CartItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cart_id' => function() {
                return Cart::factory()->create()->id;
            },
            'product_id' => function() {
                return Product::factory()->create()->id;
            },
            'qty' => $this->faker->randomDigit
        ];
    }
}
