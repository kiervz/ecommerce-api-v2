<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->authUser();
    }

    public function test_fetch_all_categories()
    {
        $this->createCategories();
        $response = $this->get(route('category.index'))
            ->assertSuccessful();

        $response->assertJsonCount(10, 'response');
    }
}
