<?php

namespace App\Policies;

use App\User;
use App\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create comments.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->can('create-comment')) {

            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the comment.
     *
     * @param  \App\User  $user
     * @param  \App\Comment  $comment
     * @return mixed
     */
    public function update(User $user, Comment $comment)
    {
        if ($user->can('update-own-comment', $comment)) {

            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the comment.
     *
     * @param  \App\User  $user
     * @param  \App\Comment  $comment
     * @return mixed
     */
    public function delete(User $user, Comment $comment)
    {
        if ($user->can('delete-own-comment', $comment)) {

            return true;
        }

        return false;
    }

    public function rate(User $user, Comment $comment)
    {
        if ($user->can('rate-comment', $comment)) {

            return true;
        }

        return false;
    }
}
