<?php

namespace App\Http\Controllers\Api\v1\Event;

use App\Http\Controllers\Controller;
use App\Http\Requests\Event\SubscribeToEventRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\JsonResponse;

/**
 * Class Subscribe
 * @authenticated
 * @package App\Http\Controllers\Api\v1\Event
 */
class Subscribe extends Controller
{
    public function __invoke(SubscribeToEventRequest $request, Event $event): JsonResponse
    {

        if ($this->isUserSubscribedTo($event)) {
            $event->subscribers()->detach(auth()->user());
        } else {
            $event->subscribers()->attach(auth()->user());

        }

        return response()->json($this->toResponseWithStruct(new EventResource($event)),201);

    }

    private function isUserSubscribedTo($event)
    {
        return $event->subscribers()
                ->where('subscriber_id', auth()->user()->id)
                ->whereHas('events', function ($q) use ($event) {$q->where('i', $event->id);})
                ->exists();
    }
}
