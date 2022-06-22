<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Store\StoreStoreRequest;
use App\Http\Requests\Store\StoreUpdateRequest;
use App\Http\Resources\Store\StoreResource;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Auth;

class StoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('isSeller', ['only' => 'store']);
    }

    public function index()
    {
        $stores = Store::all();

        return $this->customResponse('fetched all stores', $stores);
    }

    public function show(Store $store)
    {
        return $this->customResponse('Store fetch successfully!', new StoreResource($store));
    }

    public function store(StoreStoreRequest $request)
    {
        $store = $request->user()->store()->create($request->validated());

        return $this->customResponse('Store created successfully!', new StoreResource($store), Response::HTTP_CREATED);
    }

    public function update(Store $store, StoreUpdateRequest $request)
    {
        $store->update($request->validated());

        return $this->customResponse('Store updated successfully!', new StoreResource($store), Response::HTTP_OK);
    }

    public function destroy(Store $store)
    {
        $store->delete();

        return $this->customResponse('Store deleted successfully!', [], Response::HTTP_NO_CONTENT);
    }
}
