<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->authUser();
        $this->createStores(10);
    }

    public function test_example()
    {
        $this->get(route('store.index'))->assertSuccessful();

        $this->assertDatabaseCount('stores', 10);
    }
}
