<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\Country;
use App\Models\Language;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

/**
 * Class Update
 * @group Users Endpoints
 * @authenticated
 * @package App\Http\Controllers\Api\v1\User
 */
class Update extends Controller
{
    /**
     * PUT api/user/{user?}
     *
     * Method for updating information about users, if the user updates himself, it is not necessary to specify the user_id
     */
    public function __invoke(UserUpdateRequest $request, User $user): JsonResponse
    {
        if(!$user->id)  {
            $user = \auth()->user();
        }

        $this->authorize('update', $user);
        $data = $request->validated();

        if(!empty($data['languages'])) {
            $user->languages()->sync($data['languages']);
        }

        if(!empty($data['country_id'])) {
            $user->country()->associate(Country::find($data['country_id']));
        }

        if(!empty($data['native_language'])) {
            $user->nativeLanguage()->associate(Language::find($data['native_language']));
        }

        if(!empty($data['role_id']) && auth()->id() != $user->id) {
            $role = Role::find($data['role_id']);
            $user->syncRoles($role);
        }

        $user->update($data);
        $user->save();

        return response()->json(new UserResource($user));
    }
}
