<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\SubCategory\SubCategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10);

        return $this->customResponse('results', CategoryResource::collection($categories));
    }

    public function show(Category $category)
    {
        return $this->customResponse('Category fetch successfully!', new CategoryResource($category));
    }

    public function store(CategoryStoreRequest $request)
    {
        $category = Category::create($request->validated());

        return $this->customResponse('Category created successfully!', new CategoryResource($category), Response::HTTP_CREATED);
    }

    public function update(Category $category, CategoryUpdateRequest $request)
    {
        $category->update($request->validated());

        return $this->customResponse('Category updated successfully!',new CategoryResource($category), Response::HTTP_OK);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return $this->customResponse('Category deleted successfully!', [], Response::HTTP_NO_CONTENT);
    }

    public function getSubCategoriesByCategory(Category $category)
    {
        return $this->customResponse('fetched successfully', SubCategoryResource::collection($category->subCategories));
    }
}
