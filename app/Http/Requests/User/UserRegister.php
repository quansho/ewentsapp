<?php

namespace App\Http\Requests\User;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\ErrorResource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * Class UserRegister
 * @package App\Http\Requests\User
 */
class UserRegister extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|regex:/[а-яА-Яa-zA-Z_ ]*$/',
            'lastname' => 'required|string|regex:/[а-яА-Яa-zA-Z_ ]*$/',
            'login' => 'required|string|max:255|unique:users',
            'birth' => 'nullable|date',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ];
    }


}
