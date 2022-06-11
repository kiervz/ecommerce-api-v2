<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Segment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           'user_id' => function() {
                return User::factory()->create()->id;
           },
           'segment_id' => function() {
                return Segment::factory()->create()->id;
           },
           'name' => $this->faker->word(10, true)
        ];
    }
}
