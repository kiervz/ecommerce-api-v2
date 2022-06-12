<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

use Str;

class SubCategoryFactory extends Factory
{
    protected $model = SubCategory::class;

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
           'category_id' => function() {
                return Category::factory()->create()->id;
           },
           'name' => $name,
           'slug' => $slug
        ];
    }
}
