<?php

namespace App\Http\Controllers\Api\v1\Event;

use App\Http\Controllers\ApiController as Controller;

use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class Index
 * @authenticated
 * @package App\Http\Controllers\Api\v1\Event
 */
class Index extends Controller
{
    /**
     * GET api/events
     */
    public function __invoke(Request $request): JsonResponse
    {
        $events = Event::query()->paginate(10);

        return response()->json($this->toResponseWithStruct(EventResource::collection($events)->response()->getData()));

    }

}
