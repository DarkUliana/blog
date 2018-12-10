<?php

namespace App\Classes\Authorization;

use Dlnsk\HierarchicalRBAC\Authorization;


/**
 *  This is example of hierarchical RBAC authorization configiration.
 */

class AuthorizationClass extends Authorization
{
	public function getPermissions() {
		return config('roles.roles');
	}

	public function getRoles() {
		return config('roles.permissions');
	}


	/**
	 * Methods which checking permissions.
	 * Methods should be present only if additional checking needs.
	 */

	public function editOwnPost($user, $post) {
		$post = $this->getModel(\App\Post::class, $post);  // helper method for geting model

		return $user->id === $post->user_id;
	}

}
