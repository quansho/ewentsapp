<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class Index
 * @group Users Endpoints
 * @authenticated
 * @package App\Http\Controllers\Api\v1\User
 */
class Index extends Controller
{
    /**
     * GET api/users
     */

    public function __invoke(Request $request): JsonResponse
    {
        $users =  User::query()->paginate(10);

        return response()->json(UserResource::collection($users)->response()->getData());
    }
}
