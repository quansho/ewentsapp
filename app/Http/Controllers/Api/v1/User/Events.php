<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class Events
 * @authenticated
 * @package App\Http\Controllers\Api\v1\User
 */
class Events extends ApiController
{
    public function __invoke(Request $request, User $user): JsonResponse
    {
        $this->authorize('show', $user);

        return response()->json($this->toResponseWithStruct(EventResource::collection($user->events)->response()->getData()));
    }
}
