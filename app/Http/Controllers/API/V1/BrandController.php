<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();

        return $this->customResponse('results', $brands);
    }

    public function store(Request $request)
    {
        $brand = Brand::create($request->all());

        return $this->customResponse('Brand created successfully!', $brand, Response::HTTP_CREATED);
    }
}
