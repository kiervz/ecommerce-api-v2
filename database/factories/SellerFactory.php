<?php

namespace Database\Factories;

use App\Models\Seller;
use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SellerFactory extends Factory
{
    protected $model = Seller::class;

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
            'firstname' => $this->faker->word(10, true),
            'middlename' => $this->faker->word(10, true),
            'lastname' => $this->faker->word(10, true),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'birthday' => $this->faker->date,
            'contact_no' => $this->faker->numerify('####-###-####'),
            'address' => $this->faker->text(100),
            'is_verified' => 0,
        ];
    }
}
