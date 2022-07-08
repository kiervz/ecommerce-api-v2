<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Segment;
use App\Models\Seller;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'seller_id' => function() {
                return Seller::factory()->create()->id;
            },
            'brand_id' => function() {
                return Brand::factory()->create()->id;
            },
            'segment_id' => function() {
                return Segment::factory()->create()->id;
            },
            'category_id' => function() {
                return Category::factory()->create()->id;
            },
            'sub_category_id' => function() {
                return SubCategory::factory()->create()->id;
            },
            'sku' => strtoupper($this->faker->regexify('[A-Za-z0-9]{20}')),
            'name' => $this->faker->text(20),
            'unit_price' => $this->faker->randomFloat(2),
            'discount' => $this->faker->randomDigit,
            'actual_price' => $this->faker->randomFloat(2),
            'stock' => $this->faker->randomDigit,
            'description' => $this->faker->text(150)
        ];
    }
}
