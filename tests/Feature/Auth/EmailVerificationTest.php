<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class EmailVerificationTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $login;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = $this->createUser();
        $this->login = $this->post(route('auth.login'), [
            'email' => $this->user['email'],
            'password' => 'password'
        ]);
    }

    public function test_verify_email_address()
    {
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $this->user->id, 'hash' => sha1($this->user->email)],
            false
        );

        $link = "http://127.0.0.1:8000" . $verificationUrl;

        $this->get($link, [
            'Accept' => 'application/json',
            'Authorization' => $this->login['response']['token_type'] . ' ' . $this->login['response']['token']
        ])->assertSuccessful();
    }

    public function test_send_verification_to_users_email()
    {
        $response = $this->post(route('verification.email'), [], [
            'Accept' => 'application/json',
            'Authorization' => $this->login['response']['token_type'] . ' ' . $this->login['response']['token']
        ])->assertSuccessful();
    }
}
