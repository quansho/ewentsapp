<?php

namespace App\Http\Requests\User;

use App\Http\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

/**
 * Class WorkerUserUpdateRequest
 * @bodyParam gender boolean (0 - Мужчина 1 - Женщина)
 * @package App\Http\Requests
 */
class UserUpdateRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('update');
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
        ];
    }
}
