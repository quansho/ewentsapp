<?php

namespace App\Http\Requests\Event;

use App\Http\Requests\ApiRequest;

/**
 * Class UserRegister
 * @package App\Http\Requests\Event
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
