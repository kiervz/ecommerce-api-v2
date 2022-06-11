<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Segment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SegmentController extends Controller
{
    public function index()
    {
        $segments = Segment::all();

        return $this->customResponse('result', $segments);
    }

    public function show(Segment $segment)
    {
        return $this->customResponse('Segment fetch successfully!', $segment);
    }

    public function store(Request $request)
    {
        $segment = Segment::create([
            'name' => $request['name']
        ]);

        return $this->customResponse('Segment fetch successfully!', $segment, Response::HTTP_CREATED);
    }
}
