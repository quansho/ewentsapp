<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class Show
 * @group Users Endpoints
 * @authenticated
 * @package App\Http\Controllers\Api\v1\User
 */
class Show extends Controller
{
    public function __invoke(Request $request, User $user): JsonResponse
    {
        $this->authorize('show', $user);

        if(auth()->user()->hasRole('owner')) {
            $company = auth()->user()->company()->first();
            $userLogs = $user->logs()
                ->where('company_id', auth()->user()->company()->first()->id)
                ->get()
                ->toArray();

            if ($user->hasRole('worker') && empty($userLogs)) {
                $status = Status::where('title', 'Viewed')->first();

                $log = new UserLog();
                $log->user()->associate($user);
                $log->status()->associate($status);
                $log->company()->associate($company);
                $log->save();
            }
        }

        $alerts = match ($user->getRoleNames()->first()) {
            'worker' => $user->alerts()->get(),
            default => $user->company()->first()->alerts()->get()
        };

        $user->alerts = $alerts;

        return response()->json(new UserResource($user));
    }
}
