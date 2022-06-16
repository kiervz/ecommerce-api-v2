<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\BrandStoreRequest;
use App\Http\Requests\Brand\BrandUpdateRequest;
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

    public function update(Brand $brand, BrandUpdateRequest $request)
    {
        $brand->slug = null;
        $brand->update($request->validated());

        return $this->customResponse('Brand updated successfully!', new BrandResource($brand), Response::HTTP_OK);
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();

        return $this->customResponse('Brand deleted successfully!', [], Response::HTTP_NO_CONTENT);
    }

}
