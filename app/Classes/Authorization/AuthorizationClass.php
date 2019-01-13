<?php

namespace App\Classes\Authorization;

use Dlnsk\HierarchicalRBAC\Authorization;


/**
 *  This is example of hierarchical RBAC authorization configiration.
 */
class AuthorizationClass extends Authorization
{
    public function getPermissions()
    {

        return config('roles.permissions');

    }

    public function getRoles()
    {

        return config('roles.roles');
    }


    /**
     * Methods which checking permissions.
     * Methods should be present only if additional checking needs.
     */

    public function updateOwnPost($user, $post)
    {
        $post = $this->getModel('App\Post', $post);  // helper method for getting model

        return $user->id == $post->user_id;
    }

    public function deleteOwnPost($user, $post)
    {
        return $this->updateOwnPost($user, $post);
    }

    public function updateOwnComment($user, $comment)
    {
        $comment = $this->getModel('App\Comment', $comment);  // helper method for getting model

        return $user->id == $comment->user_id;
    }

    public function deleteOwnComment($user, $comment)
    {
        return $this->updateOwnComment($user, $comment);
    }

    public function rateComment($user, $comment)
    {
        $comment = $this->getModel('App\Comment', $comment);

        $ratings = $comment->ratings()->where('user_id', $user->id)->get();

        return $comment->user_id != $user->id && $ratings->isEmpty();
    }
}
