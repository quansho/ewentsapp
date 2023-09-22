<?php

namespace App\Http\Controllers\Api\v1\Event;

use App\Http\Controllers\Controller;
use App\Http\Requests\Event\EventStoreRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\JsonResponse;


/**
 * Class Store
 * @authenticated
 * @package App\Http\Controllers\Api\v1\Event
 */
class Store extends Controller
{
    public function __invoke(EventStoreRequest $request): JsonResponse
    {
        $data = $request->validated();

        $event = Event::create($data);
        $event->author()->associate(auth()->user());
        $event->save();

        return response()->json(new EventResource($event), 201);
    }
}
