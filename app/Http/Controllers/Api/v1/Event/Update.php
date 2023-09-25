<?php

namespace App\Http\Controllers\Api\v1\Event;

use App\Http\Controllers\ApiController as Controller;
use App\Http\Requests\Event\EventUpdateRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\JsonResponse;

/**
 * Class Update
 * @authenticated
 * @package App\Http\Controllers\Api\v1\Event
 */
class Update extends Controller
{
    /**
     * PUT api/events/{event}
     *
     * Method for updating information about event
     */
    public function __invoke(EventUpdateRequest $request, Event $event): JsonResponse
    {
       $event->update($request->validated());

       return response()->json($this->toResponseWithStruct(new EventResource($event)));

    }
}
