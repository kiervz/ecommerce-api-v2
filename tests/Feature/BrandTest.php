<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BrandTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->authUser();
        $this->createBrands(10);
    }

    public function test_can_fetch_all_brands()
    {
        $this->get(route('brand.index'))->assertSuccessful();

        $this->assertDatabaseCount('brands', 10);
    }

    public function  test_can_store_brand()
    {
        $this->post(route('brand.store'), [
            'user_id' => $this->authUser()->id,
            'name' => 'Nike'
        ])->assertCreated();

        $this->assertDatabaseHas('brands', ['name' => 'Nike']);
    }
}
