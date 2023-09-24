<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class EventPolicy
 * @package App\Policies
 */
class EventPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return $user->hasRole('admin');
    }

    public function update(User $user, Event $event)
    {
        return $user->id === $event->author_id;
    }

    public function delete(User $user,Event $event)
    {
        return $user->id === $event->author_id;
    }

    public function subscribe(User $user, Event $event)
    {
        return $user->id !== $event->author_id;
    }
}
