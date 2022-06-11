<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return $this->customResponse('results', $categories);
    }

    public function show(Category $category)
    {
        return $this->customResponse('Category fetch successfully!', $category);
    }

    public function store(Request $request)
    {
        $category = Category::create([
            'user_id' => $request['user_id'],
            'segment_id' => $request['segment_id'],
            'name' => $request['name']
        ]);

        return $this->customResponse('Category created successfully!', $category);
    }
}
