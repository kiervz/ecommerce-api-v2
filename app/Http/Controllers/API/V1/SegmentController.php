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

    public function update(Segment $segment, Request $request)
    {
        $segment->update([
            'name' => $request['name']
        ]);

        return $this->customResponse('Segment updated successfully!', $segment, Response::HTTP_OK);
    }

    public function destroy(Segment $segment)
    {
        $segment->delete();

        return $this->customResponse('Segment deleted successfully!', [], Response::HTTP_NO_CONTENT);
    }
}
