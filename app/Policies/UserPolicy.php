<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class UserPolicy
 * @package App\Policies
 */
class UserPolicy
{
    use HandlesAuthorization;

    public function update(User $user, User $userToUpdate)
    {
        return $user->id === $userToUpdate->id;
    }

    public function delete(User $user,User $toDelete)
    {
        return $user->id === $toDelete->id;
    }
}
