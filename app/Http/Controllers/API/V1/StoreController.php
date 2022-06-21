<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;

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
}
