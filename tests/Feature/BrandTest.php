<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BrandTest extends TestCase
{
    use RefreshDatabase;

    protected $brand;

    public function setUp(): void
    {
        parent::setUp();
        $this->authUser();
        $this->createBrands(10);
        $this->brand = $this->createBrand();
    }

    public function test_can_fetch_all_brands()
    {
        $this->get(route('brand.index'))->assertSuccessful();

        $this->assertDatabaseCount('brands', 10);
    }

    public function test_can_fetch_specific_brand_by_slug()
    {
        $this->get(route('brand.show', $this->brand))->assertSuccessful();
    }

    public function test_can_store_brand()
    {
        $this->post(route('brand.store'), [
            'user_id' => $this->authUser()->id,
            'name' => 'Nike'
        ])->assertCreated();

        $this->assertDatabaseHas('brands', ['name' => 'Nike']);
    }

    public function test_can_update_brand()
    {
        $this->put(route('brand.update', $this->brand), [
            'name' => 'Hello Brand'
        ])->assertOk();

        $this->assertDatabaseHas('brands', ['name' => 'Hello Brand']);
    }

    public function test_can_delete_brand()
    {
        $this->delete(route('brand.destroy', $this->brand))
            ->assertNoContent();

        $this->assertDatabaseHas('brands', ['deleted_at' => now()]);
    }
}
