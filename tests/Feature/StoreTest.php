<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    protected $store;

    public function setUp(): void
    {
        parent::setUp();
        $this->authUser();
        $this->createStores(10);
        $this->store = $this->createStore();
    }

    public function test_can_fetch_all_stores()
    {
        $this->get(route('store.index'))->assertSuccessful();

        $this->assertDatabaseCount('stores', 11);
    }

    public function test_can_fetch_specific_store()
    {
        $this->get(route('store.show', ['store' => $this->store]))
            ->assertSuccessful();
    }

    public function test_if_can_create_store()
    {
        $this->post(route('store.store'), [
            'seller_id' => $this->createSeller()->id,
            'name' => 'Microsoft',
            'bio' => 'sample bio',
            'last_log' => now()
        ])->assertCreated();

        $this->assertDatabaseHas('stores', ['name' => 'Microsoft']);
    }
}
