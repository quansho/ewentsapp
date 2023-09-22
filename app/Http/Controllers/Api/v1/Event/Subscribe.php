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

        $subscribed = $event->subscribers()
            ->where('subscriber_id', auth()->user()->id)
            ->whereHas('events', function ($q) use ($event) {
                $q->where('id', $event->id);
            })->exists();

        if ($subscribed) {
            $event->subscribers()->detach(auth()->user());
        } else {
            $event->subscribers()->attach(auth()->user());

        }


        return response()->json(new EventResource($event), 201);


    }
}
