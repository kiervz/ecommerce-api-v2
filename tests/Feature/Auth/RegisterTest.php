<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private function userData($role_id)
    {
        return [
            'username' => $this->faker()->word(10, true),
            'email' => $this->faker()->unique()->safeEmail(),
            'password' => 'password',
            'password_confirmation' => 'password',
            'role_id' => $role_id,
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
        $data = $this->userData(User::USER_ROLE_ADMIN);

        $this->post(route('auth.register'), $data)
            ->assertCreated();
    }

    public function test_if_user_can_register_as_seller()
    {
        $data = $this->userData(User::USER_ROLE_SELLER);

        $this->post(route('auth.register'), $data)
            ->assertCreated();
    }

    public function test_if_user_can_register_as_customer()
    {
        $data = $this->userData(User::USER_ROLE_CUSTOMER);

        $this->post(route('auth.register'), $data)
            ->assertCreated();
    }

}
