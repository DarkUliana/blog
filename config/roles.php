<?php
return [

    'roles' => [
        'admin' => [
            'update-user',

        ],
        'editor' => [
            'create-post',

        ],
        'user' => [
            'create-comment',

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


    ]
];