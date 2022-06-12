<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubCategoryTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->authUser();
    }

    public function test_fetch_all_sub_categories()
    {
        $this->createSubCategories(10);

        $this->get(route('sub-category.index'))
            ->assertSuccessful();

        $this->assertDatabaseCount('sub_categories', 10);
    }
}
