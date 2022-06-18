<?php

namespace Tests;

use App\Models\Admin;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Segment;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Sanctum\Sanctum;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }

    public function createUser($args = [])
    {
        return User::factory()->create($args);
    }

    public function createAdmin($args = [])
    {
        return Admin::factory()->create($args);
    }

    public function authUser()
    {
        $user = $this->createUser();

        Sanctum::actingAs($user);

        return $user;
    }

    public function createSegment($args = [])
    {
        return Segment::factory()->create($args);
    }

    public function createSegments($args = [])
    {
        return Segment::factory(10)->create($args);
    }

    public function createCategory($args = [])
    {
        return Category::factory()->create($args);
    }

    public function createCategories($args = [])
    {
        return Category::factory(10)->create($args);
    }

    public function createSubCategory($args = [])
    {
        return SubCategory::factory()->create($args);
    }

    public function createSubCategories($total)
    {
        return SubCategory::factory($total)->create();
    }

    public function createBrand($args = [])
    {
        return Brand::factory()->create($args);
    }

    public function createBrands($total)
    {
        return Brand::factory($total)->create();
    }

    public function createProduct($args = [])
    {
        return Product::factory()->create($args);
    }

    public function createProducts($total)
    {
        return Product::factory($total)->create();
    }
}
