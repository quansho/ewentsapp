<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Notifications\NewCompanyUser;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

/**
 * Class Store
 * @group Users Endpoints
 * @authenticated
 * @package App\Http\Controllers\Api\v1\User
 */
class Store extends Controller
{
    public function __invoke(UserStoreRequest $request): JsonResponse
    {
        $data = $request->validated();

        $password = Str::random(12);
        $data += ['password' => Hash::make($password)];
        $role = Role::find($data['role_id']);

        if(!$role) {
            return response()->json('Role not found');
        }

        $user = new User($data);
        $user->company()->associate(auth()->user()->company()->first());
        $user->save();

        $user->assignRole($role);

        $user->markEmailAsVerified();
        event(new Verified($user));


        $user->notify(new NewCompanyUser($user,$password));

        return response()->json(new UserResource($user), 201);
    }
}
