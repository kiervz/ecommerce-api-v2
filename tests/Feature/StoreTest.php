<?php

namespace Tests\Feature;

use App\Models\User;
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
        $this->createStores(10);
        $this->authUserAs(User::USER_ROLE_SELLER);
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
            'name' => 'Microsoft',
            'bio' => 'sample bio'
        ])->assertCreated();

        $this->assertDatabaseHas('stores', ['name' => 'Microsoft']);
    }

    public function test_can_update_store()
    {
        $this->put(route('store.update', ['store' => $this->store]), [
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
