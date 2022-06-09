<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

class RegisterTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private function userData($role_id)
    {
        return [
            'username' => $this->faker()->word(10, true),
            'email' => $this->faker()->unique()->safeEmail(),
            'password' => 'password',
            'role_id' => $role_id,
            'remember_token' => Str::random(10),
            'firstname' => $this->faker()->firstName(),
            'lastname' => $this->faker()->lastName(),
            'middlename' => $this->faker()->word(5, true),
            'gender' => $this->faker()->randomElements(['male', 'female'])[0],
            'birthday' => $this->faker()->date('Y-m-d', 'now'),
            'contact_no' => $this->faker()->phoneNumber
        ];
    }

    public function test_if_user_can_register_as_admin()
    {
        $data = $this->userData(1);

        $this->post(route('auth.register'), $data)
            ->assertCreated();
    }

    public function test_if_user_can_register_as_seller()
    {
        $data = $this->userData(2);

        $this->post(route('auth.register'), $data)
            ->assertCreated();
    }

    public function test_if_user_can_register_as_customer()
    {
        $data = $this->userData(3);

        $this->post(route('auth.register'), $data)
            ->assertCreated();
    }

}
