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
            'user_id' => $this->createSeller()->id,
            'name' => 'Microsoft',
            'bio' => 'sample bio'
        ])->assertCreated();

        $this->assertDatabaseHas('stores', ['name' => 'Microsoft']);
    }

    public function test_can_update_store()
    {
        $this->put(route('store.update', ['store' => $this->store]), [
            'user_id' => $this->createSeller()->id,
            'name' => 'Apple Inc.',
            'bio' => 'sample bio'
        ])->assertOk();

        $this->assertDatabaseHas('stores', ['name' => 'Apple Inc.']);
    }

    public function test_can_delete_store()
    {
        $this->delete(route('store.destroy', $this->store->slug))
            ->assertNoContent();

        $this->assertDatabaseHas('stores', ['deleted_at' => now()]);
    }
}
