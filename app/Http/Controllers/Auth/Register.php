<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRegister;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

/**
 * Class Register
 * @package App\Http\Controllers\Auth
 */
class Register extends Controller
{
    /**
     * @group Auth Endpoints
     * @param UserRegister $request
     * @return JsonResponse
     */
    public function __invoke(UserRegister $request): JsonResponse
    {
        $user = new User([
            'login' => $request->get('login'),
            'name' => $request->get('name'),
            'lastname' => $request->get('lastname'),
            'birth' => $request->get('birth'),
            'password' => bcrypt($request->get('password')),
        ]);


        $user->save();

        $token = $user->createToken('api')->plainTextToken;

        Auth::login($user);

        return response()->json((new UserResource($user))->setPlainTextToken($token, $request), 201);
    }
}
