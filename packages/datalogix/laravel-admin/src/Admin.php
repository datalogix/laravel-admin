<?php

namespace Datalogix\Admin;

use Datalogix\Admin\Tools\Dashboard as DashboardTool;
use Datalogix\Admin\Tools\Resources as ResourcesTool;
use Datalogix\Admin\Traits\Assets;
use Datalogix\Admin\Traits\Boot;
use Datalogix\Admin\Traits\Configurable;
use Datalogix\Admin\Traits\Resources;
use Datalogix\Admin\Traits\Searchable;
use Datalogix\Admin\Traits\Tools;
use Datalogix\Admin\View\AppComposer;
use Illuminate\Http\Request;

class Admin
{
    use Assets,
        Boot,
        Configurable,
        Resources,
        Searchable,
        Tools;

    public static function connection()
    {
        return config('admin.database.connection') ?: config('database.default');
    }

    public static function guard()
    {
        return auth(config('admin.auth.guard'));
    }

    public static function user()
    {
        return static::guard()->user();
    }

    public static function routes()
    {
        $attributes = [
            'prefix'     => config('admin.route.prefix'),
            'middleware' => config('admin.route.middleware'),
        ];

        app('router')->group($attributes, function ($router) {
            $loginController = config('admin.controllers.login');
            $router->get('login', $loginController.'@showLoginForm')->name('admin.login');
            $router->post('login', $loginController.'@login');
            $router->match(['get', 'post'], 'logout', $loginController.'@logout')->name('admin.logout');

            if (config('admin.auth.reset_password')) {
                $requestPasswordController = config('admin.controllers.password.request');
                $resetPasswordController = config('admin.controllers.password.reset');

                $router->get('password/reset', $requestPasswordController.'@showLinkRequestForm')->name('admin.password.request');
                $router->post('password/email', $requestPasswordController.'@sendResetLinkEmail')->name('admin.password.email');
                $router->get('password/reset/{token}', $resetPasswordController.'@showResetForm')->name('admin.password.reset');
                $router->post('password/reset', $resetPasswordController.'@reset')->name('admin.password.update');
            }

            $routerController = config('admin.controllers.router');
            $router->get('api/styles/{style}', $routerController.'@getStyle')->name('admin.style');
            $router->get('api/scripts/{script}', $routerController.'@getScript')->name('admin.script');
            $router->get('{path?}', $routerController.'@router')->where('path', '(.*)')->name('admin');
        });
    }

    public static function init(Request $request)
    {
        $tools = [new DashboardTool];

        $resources = static::availableResources($request);
        if ($resources->isNotEmpty()) {
            $tools[] = new ResourcesTool($resources->toArray());
        }

        static::$tools =  collect($tools)->concat(static::$tools)->toArray();
        static::availableTools($request);

        view()->composer('admin::layouts.app', AppComposer::class);
    }
}
