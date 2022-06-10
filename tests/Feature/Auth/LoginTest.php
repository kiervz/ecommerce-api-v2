<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

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

    public function test_if_user_can_logout()
    {
        $user = $this->createUser();

        $credentials = [
            'email' => $user['email'],
            'password' => 'password'
        ];

        $data = $this->post(route('auth.login'), $credentials)
            ->assertSuccessful()
            ->json();

        $this->post(route('auth.logout'), [], [
            'Authorization' => "{$data['response']['token_type']} {$data['response']['token']}"
        ])->assertNoContent();
    }
}
