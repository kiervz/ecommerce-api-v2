<?php

namespace Database\Factories;

use App\Models\Seller;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class StoreFactory extends Factory
{
    protected $model = Store::class;

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
            'user_id' => $this->faker->randomDigitNotZero(),
            'name' => $name,
            'slug' => $slug,
            'bio' => $this->faker->text(100)
        ];
    }
}
