<?php

namespace App\Http\Requests\Event;

use App\Http\Requests\ApiRequest;

/**
 * Class EventStoreRequest
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
            'title' => 'string|regex:/[а-яА-Яa-zA-Z_ ]*$/',
            'description' => 'string|regex:/[а-яА-Яa-zA-Z_ ]*$/|max:1000',
        ];
    }


}
