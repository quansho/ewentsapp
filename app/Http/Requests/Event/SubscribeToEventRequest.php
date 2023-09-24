<?php

namespace App\Http\Requests\Event;

use App\Http\Requests\ApiRequest;

/**
 * Class SubscribeToEventRequest
 * @package App\Http\Requests\Event
 */
class SubscribeToEventRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('subscribe');
    }

}
