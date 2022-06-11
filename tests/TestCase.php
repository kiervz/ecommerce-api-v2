<?php

namespace Tests;

use App\Models\Admin;
use App\Models\Segment;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Sanctum\Sanctum;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }

    public function createUser($args = [])
    {
        return User::factory()->create($args);
    }

    public function createAdmin($args = [])
    {
        return Admin::factory()->create($args);
    }

    public function authUser()
    {
        $user = $this->createUser();

        Sanctum::actingAs($user);

        return $user;
    }

    public function createSegment($args = [])
    {
        return Segment::factory(10)->create($args);
    }
}
