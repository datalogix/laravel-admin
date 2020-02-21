<?php

namespace Datalogix\Admin\Traits;

use Composer\Autoload\ClassMapGenerator;
use Datalogix\Admin\Resource;
use Illuminate\Http\Request;
use ReflectionClass;

trait Resources
{
    protected static $resources = [];
    protected static $availableResources = null;

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
}
