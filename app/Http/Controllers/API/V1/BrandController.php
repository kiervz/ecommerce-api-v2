<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\BrandStoreRequest;
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

    public function show(Brand $brand)
    {
        return $this->customResponse('Brand fetched successfully!', new BrandResource($brand));
    }

    public function store(BrandStoreRequest $request)
    {
        $brand = Brand::create($request->all());

        return $this->customResponse('Brand created successfully!', new BrandResource($brand), Response::HTTP_CREATED);
    }

}
