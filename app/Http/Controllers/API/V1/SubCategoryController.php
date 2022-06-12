<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubCategory\SubCategoryResource;
use App\Models\SubCategory;
use Illuminate\Http\Request;

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
}
