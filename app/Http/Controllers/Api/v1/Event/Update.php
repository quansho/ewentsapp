<?php

namespace App\Http\Controllers\Api\v1\Event;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\JsonResponse;

/**
 * Class Update
 * @authenticated
 * @package App\Http\Controllers\Api\v1\Event
 */
class Update extends Controller
{
    /**
     * PUT api/user/{user?}
     *
     * Method for updating information about users, if the user updates himself, it is not necessary to specify the user_id
     */
    public function __invoke(UserUpdateRequest $request, Event $event): JsonResponse
    {
       $event->update($request->validated());

        return response()->json(new EventResource($event));
    }
}
