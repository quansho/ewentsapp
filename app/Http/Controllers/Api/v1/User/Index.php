<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class Index
 * @authenticated
 * @package App\Http\Controllers\Api\v1\User
 */
class Index extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $users =  User::query()->paginate(10);

        return response()->json($this->toResponseWithStruct(UserResource::collection($users)->response()->getData()));
    }
}
