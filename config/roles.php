<?php
return [

    'roles' => [
        'admin' => [
//            'update-user',
//            'update-post',
//            'delete-post',
//            'update-comment',
//            'delete-comment',
//            'create-post'
//для адміна дозволи можна не вказувати, так як ніяких провірок він не проходить, тобто йому можна все
        ],
        'editor' => [
            'update-own-post',
            'delete-own-post',
            'update-own-comment',
            'delete-own-comment',
            'create-post'
        ],
        'user' => [
            'update-own-comment',
            'delete-own-comment'
        ],
    ],


    'permissions' => [
        'update-user' => [
        ],


        'update-post' => [

        ],
        'update-own-post' => [
            'next' => 'update-post'
        ],
        'create-post' => [
            'next' => 'update-own-post'
        ],

        'delete-post' => [
            'equal' => 'update-post'
        ],
        'delete-own-post' => [
            'equal' => 'update-own-post'
        ],


        'update-comment' => [

        ],
        'update-own-comment' => [
            'next' => 'update-comment'
        ],
        'create-comment' => [
            'next' => 'update-own-comment'
        ],

        'delete-comment' => [
            'equal' => 'update-comment'
//            'next' => 'delete-own-comment',
        ],
        'delete-own-comment' => [
            'equal' => 'update-own-comment'
        ],


    ],

    'default' => 'user'
];
