<?php
return [

    'roles' => [
        'admin' => [
            'update-user',

        ],
        'editor' => [
            'create-post',
            'update-own-post'

        ],
        'user' => [
            'create-comment',
            'update-own-comment'
        ],
    ],


    'permissions' => [
        'update-user' => [
            'next' => 'update-own-post',
        ],
        'create-post' => [
            'next' => 'update-comment',
        ],
        'create-comment' => [

        ],

        'update-own-post' => [
            'description' => '',
        ],

        'update-own-comment' => [
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

        'delete-own-post' => [
            'description' => '',
            'equal' => 'update-own-post',
        ],

        'delete-own-comment' => [
            'description' => '',
            'equal' => 'update-own-comment',
        ],


    ],

    'default' => 'user'
];
