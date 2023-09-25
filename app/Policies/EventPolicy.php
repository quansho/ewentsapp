<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

/**
 * Class EventPolicy
 * @package App\Policies
 */
class EventPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Event $event)
    {
        return $user->id === $event->author_id;
    }

    public function delete(User $user,Event $event)
    {
        return $user->id === $event->author_id;
    }

    public function subscribe(User $user,Event $event,)
    {
        return $user->id != $event->author_id;
    }
}
