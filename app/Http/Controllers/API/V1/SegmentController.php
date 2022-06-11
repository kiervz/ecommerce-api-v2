<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Segment;
use Illuminate\Http\Request;

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
}
