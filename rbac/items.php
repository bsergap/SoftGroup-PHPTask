<?php
return [
    'guest' => [
        'type' => 1,
    ],
    'waiter' => [
        'type' => 1,
        'description' => 'Waiter',
        'children' => [
            'serving',
        ],
    ],
    'cook' => [
        'type' => 1,
        'description' => 'Cook',
        'children' => [
            'cooking',
        ],
    ],
    'admin' => [
        'type' => 1,
        'description' => 'Admin',
        'children' => [
            'cook',
            'waiter',
        ],
    ],
    'serving' => [
        'type' => 2,
    ],
    'cooking' => [
        'type' => 2,
    ],
];
