<?php

namespace App\Http\Requests\User;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\ErrorResource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
/**
 * Class UserRegister
 * @bodyParam first_name string required
 * @bodyParam last_name string required
 * @bodyParam email string required
 * @bodyParam password string required
 * @bodyParam password_confirmation string required
 * @bodyParam role_flag string required Может быть одно из двух, если регистрируем рабочего "worker", если держателя компании "owner"
 * @bodyParam company_title string Это поле обязательно, если role_flag является owner.
 * @package App\Http\Requests
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
