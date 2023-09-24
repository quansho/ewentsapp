<?php

namespace App\Http\Controllers\Api\v1\Event;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class Delete
 * @authenticated
 * @package App\Http\Controllers\Api\v1\Event
 */
class Delete extends Controller
{
    public function __invoke(Request $request, Event $event): JsonResponse
    {
        $this->authorize('delete', $event);

        $event->delete();

        return response()->json('Event deleted');
    }
}
