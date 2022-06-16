<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Brand\BrandCollection;
use App\Http\Resources\Brand\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::paginate(20);

        return $this->customResponse('results', new BrandCollection($brands));
    }

    public function store(Request $request)
    {
        $brand = Brand::create($request->all());

        return $this->customResponse('Brand created successfully!', new BrandResource($brand), Response::HTTP_CREATED);
    }
}
