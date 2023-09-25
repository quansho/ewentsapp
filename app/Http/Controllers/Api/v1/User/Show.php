<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\ApiController as Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class Show
 * @authenticated
 * @package App\Http\Controllers\Api\v1\User
 */
class Show extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function __invoke(Request $request, User $user): JsonResponse
    {
        $this->authorize('show', $user);

        return response()->json($this->toResponseWithStruct(new UserResource($user)));
    }
}
