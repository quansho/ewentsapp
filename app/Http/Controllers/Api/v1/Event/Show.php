<?php

namespace App\Http\Controllers\Api\v1\Event;

use App\Http\Controllers\ApiController as Controller;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class Show
 * @authenticated
 * @package App\Http\Controllers\Api\v1\Event
 */
class Show extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function __invoke(Request $request, Event $event): JsonResponse
    {
        $this->authorize('show', $event);

        return response()->json($this->toResponseWithStruct(new EventResource($event)));

    }
}
