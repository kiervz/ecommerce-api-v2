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
        $response = $this->post(route('category.store'), [
            'user_id' => $this->authUser()->id,
            'segment_id' => $this->createSegment()->id,
            'name' => 'Clothing'
        ])->assertSuccessful();

        $this->assertDatabaseHas('categories', ['name' => 'Clothing']); 
    }
}
