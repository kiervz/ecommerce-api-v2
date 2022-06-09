<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_if_user_can_login()
    {
        $user = $this->createUser();

        $credentials = [
            'email' => $user->email,
            'password' => 'password'
        ];

        $this->post(route('auth.login'), $credentials)
            ->assertSuccessful()
            ->assertJsonStructure([
                'response' => [
                    'user' => [
                        'id',
                        'name',
                        'email',
                        'created_at'
                    ],
                    'token_type',
                    'token'
                ]
            ]);
    }
}
