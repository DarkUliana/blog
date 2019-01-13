<?php
/**
 * Created by PhpStorm.
 * User: xxzz
 * Date: 12.01.2019
 * Time: 0:08
 */

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the post.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function update(User $user)
    {
        if ($user->can('update-user')) {

            return true;
        }

        return false;
    }
}
