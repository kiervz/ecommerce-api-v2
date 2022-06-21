<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Store\StoreStoreRequest;
use App\Http\Resources\Store\StoreResource;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::all();

        $this->customResponse('fetched all stores', $stores);
    }

    public function show(Store $store)
    {
        return $this->customResponse('Store fetch successfully!', $store);
    }

    public function store(StoreStoreRequest $request)
    {
        $store = Store::create($request->validated());

        return $this->customResponse('Store created successfully!', new StoreResource($store), Response::HTTP_CREATED);
    }
}
