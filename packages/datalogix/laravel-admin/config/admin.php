<?php

return [
    'title' => env('ADMIN_TITLE', 'Admin'),

    'name' => env('ADMIN_NAME', config('app.name', 'Admin')),

    'show_name' => true,

    'controller' => \Datalogix\Admin\Controllers\AdminController::class,

    'database' => [
        'connection' => config('database.default'),

        'tables' => [
            'users' => 'admin_users'
        ],

        'models' => [
            'users' => Datalogix\Admin\Models\User::class,
        ],
    ],

    'route' => [
        'prefix' => env('ADMIN_ROUTE_PREFIX', 'admin'),
        'middleware' => ['web', 'admin'],
    ],

    'https' => env('ADMIN_HTTPS', false),

    'bootstrap' => admin_path('bootstrap.php'),

    'directory' => app_path('Admin'),

    'auth' => [
        'controller' => \Datalogix\Admin\Controllers\AuthController::class,

        'guard' => 'admin',

        'guards' => [
            'admin' => [
                'driver'   => 'session',
                'provider' => 'admin',
            ],
        ],

        'providers' => [
            'admin' => [
                'driver' => 'eloquent',
                'model'  => Datalogix\Admin\Models\User::class,
            ],
        ],

        'redirect_to' => 'auth/login',

        'excepts' => [
            'auth/login',
            'auth/logout',
            '_handle_action_',
        ],
    ],

    'navigation' => [
        'resources' => '',
        'group_icons' => [],
    ],

    'tools' => [],
];
