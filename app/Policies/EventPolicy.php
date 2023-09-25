<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

/**
 * Class EventPolicy
 * @package App\Policies
 */
class EventPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Event $event): Response
    {
        return $user->id === $event->author_id ? Response::allow() : Response::deny("Вы не можете обновить данное событие!");
    }

    public function delete(User $user,Event $event): Response
    {
        return $user->id === $event->author_id ? Response::allow() : Response::deny("Вы не можете удалить данное событие!");
    }

    public function subscribe(User $user,Event $event,): Response
    {
            return $user->id != $event->author_id ? Response::allow() : Response::deny("Вы не можете подписаться на события, которые создали вы сами!");
    }
}
