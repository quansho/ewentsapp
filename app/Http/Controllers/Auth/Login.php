<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

/**
 * Class Login
 * @package App\Http\Controllers\Auth
 */
class Login extends Controller
{
    /**
     * @return array|JsonResponse
     * @throws ValidationException
     */
    public function __invoke(Request $request): JsonResponse|array
    {
        $rules = [
            'login' => 'required|string',
            'password' => 'required',
        ];

        if ($request->accepts('json')) {
            $toValidate = json_decode($request->getContent(), true);
            $validator = Validator::make($toValidate, $rules);
            if ($validator->passes()) {
                if (!Auth::attempt($validator->validated())) {
                    return response()->json([
                        'message' => 'Error! User not found!',
                    ], 401);
                }

                auth()->user()->tokens()->delete();

                $token = auth()->user()->createToken('api')->plainTextToken;
                $user = auth()->user();

                return response()->json((new UserResource($user))->setPlainTextToken($token, $request));
            } else {
                dd($validator->errors()->all());
            }
        }

        return response()->json([session()->errors()->all()]);

    }

}
