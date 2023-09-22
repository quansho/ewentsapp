<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class Delete
 * @group Users Endpoints
 * @authenticated
 * @package App\Http\Controllers\Api\v1\User
 */
class Delete extends Controller
{
    public function __invoke(Request $request, User $user): JsonResponse
    {
        $this->authorize('delete', $user);

        $user->delete();

        return response()->json('User deleted');
    }
}
