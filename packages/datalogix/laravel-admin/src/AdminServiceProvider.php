<?php

namespace Datalogix\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    protected $routeMiddleware = [
        'admin.auth'       => Middleware\Authenticate::class,
        //'admin.log'        => Middleware\LogOperation::class,
        'admin.bootstrap'  => Middleware\Bootstrap::class,
        // 'admin.permission' => Middleware\Permission::class,
    ];

    protected $middlewareGroups = [
        'admin' => [
            'admin.auth',
            //'admin.log',
            'admin.bootstrap',
            //'admin.permission',
        ],
    ];

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/admin.php', 'admin');

        $this->loadAdminAuthConfig();

        $this->registerRouteMiddleware();
    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'admin');

        $this->ensureHttps();
        $this->registerPublishing();
        $this->routes();

        Admin::booting(function(Request $request) {
            $this->resources();
            Admin::tools($this->tools());
            Admin::init($request);
        });
    }

    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        if (file_exists($routes = admin_path('routes.php'))) {
            $this->loadRoutesFrom($routes);
        } else {
            $this->loadRoutesFrom(__DIR__.'/routes.php');
        }
    }

    protected function loadAdminAuthConfig()
    {
        config(Arr::dot(config('admin.auth', []), 'auth.'));
    }

    protected function registerRouteMiddleware()
    {
        foreach ($this->routeMiddleware as $key => $middleware) {
            $this->app->router->aliasMiddleware($key, $middleware);
        }

        foreach ($this->middlewareGroups as $key => $middleware) {
            $this->app->router->middlewareGroup($key, $middleware);
        }
    }

    protected function ensureHttps()
    {
        if (!config('admin.https', $this->app->environment('production'))) return;

        $this->app->url->forceScheme('https');
        $this->app->request->server->set('HTTPS', true);
    }

    protected function registerPublishing()
    {
        $this->publishes([__DIR__.'/../config/admin.php' => config_path('admin.php'),], 'admin-config');
        $this->publishes([__DIR__.'/../database/migrations' => database_path('migrations')], 'admin-migrations');
        // $this->publishes([__DIR__.'/../resources/assets' => public_path('vendor/admin')], 'admin-assets');
        $this->publishes([__DIR__.'/../resources/lang' => resource_path('lang/vendor/admin')], 'admin-lang');
        $this->publishes([__DIR__.'/../resources/views' => resource_path('views/vendor/admin')], 'admin-views');
    }

    protected function resources()
    {
        if (!empty(config('admin.resources'))) {
            Admin::resources(config('admin.resources'));
        }

        if (File::isDirectory(config('admin.directory'))) {
            Admin::resourcesIn(config('admin.directory'));
        }
    }

    public function tools()
    {
        return config('admin.tools');
    }
}
