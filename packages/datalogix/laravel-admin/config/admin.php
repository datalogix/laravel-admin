<?php

return [
    'icon' => false,

    'locale' => env('ADMIN_LOCALE', config('app.locale', 'pt-BR')),

    'logo' => env('ADMIN_LOGO', 'logo.png'),

    'title' => env('ADMIN_TITLE', 'Admin'),

    'name' => env('ADMIN_NAME', config('app.name', 'Admin')),

    'loading' => 'admin-loading',

    'show_name' => true,

    'show_user_name' => true,

    'notifications' => true,

    'controllers' => [
        'router' => \Datalogix\Admin\Controllers\RouterController::class,

        'login' => \Datalogix\Admin\Controllers\Auth\LoginController::class,

        'password' => [
            'request' => \Datalogix\Admin\Controllers\Auth\RequestPasswordController::class,
            'reset' => \Datalogix\Admin\Controllers\Auth\ResetPasswordController::class,
        ],
    ],

    'database' => [
        'connection' => config('database.default'),

        'tables' => [
            'users' => 'admin_users',
            'password_resets' => 'admin_password_resets'
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

        'redirect_to' => 'login',

        'excepts' => [
            'login',
            'logout',
            'password/reset',
            'password/email',
            'password/reset/*',
            '_handle_action_',
        ],

        'reset_password' => env('ADMIN_AUTH_RESET_PASSWORD', true),

        'remember' => env('ADMIN_AUTH_REMEMBER', true),

        'passwords' => [
            'admin' => [
                'provider' => 'admin',
                'table' => 'admin_password_resets',
                'expire' => 60,
                'throttle' => 60,
            ],
        ],
    ],

    'navigation' => [
        'resources' => '',
        'group_icons' => [],
    ],

    'tools' => [],
];
