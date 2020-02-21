<?php

namespace Datalogix\Admin;

use Composer\Autoload\ClassMapGenerator;
use Datalogix\Admin\Traits\Assets;
use Datalogix\Admin\Traits\Boot;
use Datalogix\Admin\Traits\Configurable;
use Illuminate\Http\Request;
use ReflectionClass;

class Admin
{
    use Assets, Boot, Configurable;

    protected static $resources = [];
    protected static $tools = [];

    protected static $availableResources = null;
    protected static $availableTools = null;

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
            $authController = config('admin.auth.controller');
            $router->get('auth/login', $authController.'@showLoginForm')->name('admin.login');
            $router->post('auth/login', $authController.'@login');
            $router->match(['get', 'post'], 'auth/logout', $authController.'@logout')->name('admin.logout');

            $adminController = config('admin.controller');
            $router->get('api/styles/{style}', $adminController.'@getStyle')->name('admin.style');
            $router->get('api/scripts/{script}', $adminController.'@getScript')->name('admin.script');
            $router->get('{path?}', $adminController.'@router')->where('path', '(.*)')->name('admin');
        });
    }

    public static function resources(array $resources = [])
    {
        $validResources = collect($resources)->filter(function ($class) {
            $ref = new ReflectionClass($class);
            return $ref->isSubclassOf(Resource::class) && $ref->isInstantiable();
        })->toArray();

        static::$resources = array_unique(array_merge(static::$resources, $validResources));

        return new static;
    }

    public static function resourcesIn($directory)
    {
        $resources = array_keys(ClassMapGenerator::createMap($directory));

        return static::resources($resources);
    }

    public static function tools(array $tools = [])
    {
        static::$tools = array_merge(static::$tools, $tools);

        return new static;
    }

    protected static function viewComposer()
    {
        view()->composer('admin::layout', AdminComposer::class);

        return new static;
    }

    public static function init(Request $request)
    {
        static::availableResources($request);
        static::availableTools($request);

        return static::viewComposer();
    }

    public static function availableResources(Request $request)
    {
        if (is_null(static::$availableResources)) {
            static::$availableResources = collect(static::$resources)->filter(function ($resource) use ($request) {
                return $resource::displayInNavigation($request);
            })->keyBy(function ($resource) {
                return $resource::uriKey();
            })->groupBy(function ($resource) {
                return $resource::group();
            }, true)->sortKeys();
        }

        return static::$availableResources;
    }

    public static function availableTools(Request $request)
    {
        if (is_null(static::$availableTools)) {
            $tools = [new Dashboard];

            $resources = static::availableResources($request);
            if ($resources->isNotEmpty()) {
                $tools[] = new Resources($resources->toArray());
            }

            static::$availableTools = collect($tools)->concat(static::$tools)->map(function ($tool) {
                return is_string($tool) ? app($tool) : $tool;
            })->filter(function ($tool) {
                return $tool instanceof Tool;
            })->filter(function (Tool $tool) use ($request) {
                return $tool->displayInNavigation($request);
            })->each(function (Tool $tool) use ($request) {
                $tool->boot($request);
            });
        }

        return static::$availableTools;
    }

    public static function availableGlobalSearch(Request $request)
    {
        return count(static::globallySearchableResources($request)) > 0;
    }

    public static function globallySearchableResources(Request $request)
    {
        return static::availableResources($request)->flatten()->filter(function ($resource) {
            $search = $resource::search();
            return is_array($search) && count($search) > 0;
        });
    }
}
