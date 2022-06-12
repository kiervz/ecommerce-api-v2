<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubCategoryTest extends TestCase
{
    use RefreshDatabase;

    private $sub_category;

    public function setUp(): void
    {
        parent::setUp();
        $this->authUser();
        $this->sub_category = $this->createSubCategory();
    }

    public function test_fetch_all_sub_categories()
    {
        $this->createSubCategories(10);

        $this->get(route('sub-category.index'))
            ->assertSuccessful();

        $this->assertDatabaseCount('sub_categories', 11);
    }

    public function test_fetch_specific_sub_category()
    {
        $this->get(route('sub-category.show', $this->sub_category))
            ->assertSuccessful();
    }

    public function test_create_sub_category()
    {
        $this->post(route('sub-category.store'), [
            'user_id' => $this->authUser()->id,
            'category_id' => $this->createCategory()->id,
            'name' => 'Sneakers'
        ])->assertCreated();

        $this->assertDatabaseHas('sub_categories', ['name' => 'Sneakers']);
    }

    public function test_update_sub_category()
    {
        $this->put(route('sub-category.update', $this->sub_category), [
            'name' => 'Sneakers (Updated)'
        ])->assertOk();

        $this->assertDatabaseHas('sub_categories', ['name' => 'Sneakers (Updated)']);
    }
}
