<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Segment\SegmentStoreRequest;
use App\Http\Requests\Segment\SegmentUpdateRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Segment\SegmentResource;
use App\Models\Segment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SegmentController extends Controller
{
    public function index()
    {
        $segments = Segment::all();

        return $this->customResponse('result', SegmentResource::collection($segments));
    }

    public function show(Segment $segment)
    {
        return $this->customResponse('Segment fetch successfully!', $segment);
    }

    public function store(SegmentStoreRequest $request)
    {
        $segment = Segment::create($request->validated());

        return $this->customResponse('Segment created successfully!', new SegmentResource($segment), Response::HTTP_CREATED);
    }

    public function update(Segment $segment, SegmentUpdateRequest $request)
    {
        $segment->update($request->validated());

        return $this->customResponse('Segment updated successfully!', new SegmentResource($segment), Response::HTTP_OK);
    }

    public function destroy(Segment $segment)
    {
        $segment->delete();

        return $this->customResponse('Segment deleted successfully!', [], Response::HTTP_NO_CONTENT);
    }

    public function getCategoriesBySegment(Segment $segment)
    {
        return $this->customResponse('Categories by segment fetch successfully!', CategoryResource::collection($segment->categories));
    }
}
