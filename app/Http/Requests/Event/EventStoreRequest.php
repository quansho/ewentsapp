<?php

namespace App\Http\Requests\Event;

use App\Http\Requests\ApiRequest;

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
class EventStoreRequest extends ApiRequest
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
            'title' => 'required|string|regex:/[а-яА-Яa-zA-Z_ ]*$/',
            'description' => 'required|string|regex:/[а-яА-Яa-zA-Z_ ]*$/|max:1000',
        ];
    }


}
