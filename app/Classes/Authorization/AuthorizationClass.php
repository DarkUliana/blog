<?php

namespace App\Classes\Authorization;

use Dlnsk\HierarchicalRBAC\Authorization;


/**
 *  This is example of hierarchical RBAC authorization configiration.
 */

class AuthorizationClass extends Authorization
{
	public function getPermissions() {
		return [
            'update-user' => [
                'description' => 'Редактирование любых статей',
                'next' => 'update-own-post',
            ],
            'create-post' => [
                'description' => 'Редактирование собственных статей',
                'next' => 'update-comment',
            ],
            'create-comment' => [
                'description' => '',

            ],

            'delete-post' => [
                'description' => '',
                'equal' => 'update-user',
            ],
            'update-post' => [
                'description' => '',
                'equal' => 'update-user',
            ],
            'update-comment' => [
                'description' => '',
                'equal' => 'update-user',
            ],
            'delete-comment' => [
                'description' => '',
                'equal' => 'update-user',
            ],
            'update-own-post' => [
                'description' => '',
                'equal' => 'create-post',
            ],
            'delete-own-post' => [
                'description' => '',
                'equal' => 'create-post',
            ],
            'update-own-comment' => [
                'description' => '',
                'equal' => 'create-post',
            ],
            'delete-own-comment' => [
                'description' => '',
                'equal' => 'create-post',
            ],


		];
	}

	public function getRoles() {
		return [
            'admin' => [
                'update-user',

            ],
            'editor' => [
                'create-post',

            ],
            'user' => [
                'create-comment',

            ],
		];
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
