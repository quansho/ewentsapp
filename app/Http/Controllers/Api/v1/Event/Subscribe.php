<?php

namespace App\Http\Controllers\Api\v1\Event;

use App\Http\Controllers\ApiController as Controller;
use App\Http\Resources\EventResource;
use App\Models\Event;
use App\Models\Subscription;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class Subscribe
 * @authenticated
 * @package App\Http\Controllers\Api\v1\Event
 */
class Subscribe extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function __invoke(Request $request, Event $event): JsonResponse
    {
        $this->authorize('subscribe',$event);

        if (Subscription::query()->isSubscribed($event->id)) {
            $event->subscribers()->detach(auth()->user());
        } else {
            $event->subscribers()->attach(auth()->user());

        }

        return response()->json($this->toResponseWithStruct(new EventResource($event)),201);

    }
}
