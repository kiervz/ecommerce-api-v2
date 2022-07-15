<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => function() {
                return Product::factory()->create()->id;
            },
            'name' => $this->faker->word(20, true),
            'url' => $this->faker->word(50, true)
        ];
    }
}
