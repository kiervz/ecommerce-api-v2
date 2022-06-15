<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    private $category;

    public function setUp(): void
    {
        parent::setUp();
        $this->authUser();
        $this->category = $this->createCategory();
    }

    public function test_fetch_all_categories()
    {
        $this->createCategories();
        $response = $this->get(route('category.index'))
            ->assertSuccessful();

        $response->assertJsonCount(10, 'response');
    }

    public function test_fetch_specific_category()
    {
        $this->get(route('category.show', $this->category))
            ->assertSuccessful();
    }

    public function test_create_category()
    {
        $this->post(route('category.store'), [
            'user_id' => $this->authUser()->id,
            'segment_id' => $this->createSegment()->id,
            'name' => 'Clothing'
        ])->assertCreated();

        $this->assertDatabaseHas('categories', ['name' => 'Clothing']);
    }

    public function test_update_category()
    {
        $this->put(route('category.update', $this->category), [
            'name' => 'Shoes'
        ])->assertOk();

        $this->assertDatabaseHas('categories', ['name' => 'Shoes']);
    }

    public function test_delete_category()
    {
        $this->delete(route('category.destroy', $this->category->slug))
            ->assertNoContent();

        $this->assertDatabaseHas('categories', ['deleted_at' => now()]);
    }

    public function test_fetch_all_sub_categories_by_category()
    {
        $this->get(route('category.getSubCategoriesByCategory', $this->category->slug))
            ->assertSuccessful();
    }
}
