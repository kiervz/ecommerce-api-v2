<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BrandFactory extends Factory
{
    protected $model = Brand::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->word(10, true);
        $slug = Str::slug($name);

        return [
            'user_id' => function() {
                return User::factory()->create()->id;
            },
            'name' => $name,
            'slug' => $slug
        ];
    }
}
