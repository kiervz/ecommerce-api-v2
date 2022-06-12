<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategory\SubCategoryStoreRequest;
use App\Http\Requests\SubCategoryUpdateRequest;
use App\Http\Resources\SubCategory\SubCategoryResource;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubCategoryController extends Controller
{
    public function index()
    {
        $sub_categories = SubCategory::all();

        return $this->customResponse('results', SubCategoryResource::collection($sub_categories));
    }

    public function show(SubCategory $sub_category)
    {
        return $this->customResponse('fetched successfully!', new SubCategoryResource($sub_category));
    }

    public function store(SubCategoryStoreRequest $request)
    {
        $sub_category = SubCategory::create($request->validated());

        return $this->customResponse('created successfully!', new SubCategoryResource($sub_category), Response::HTTP_CREATED);
    }

    public function update(SubCategory $sub_category, SubCategoryUpdateRequest $request)
    {
        $sub_category->update($request->validated());

        return $this->customResponse('updated successfully!', new SubCategoryResource($sub_category), Response::HTTP_OK);
    }

    public function destroy(SubCategory $sub_category)
    {
        $sub_category->delete();

        return $this->customResponse('deleted successfully!', [], Response::HTTP_NO_CONTENT);
    }
}
