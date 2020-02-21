<?php

namespace Datalogix\Admin\Traits;

use Illuminate\Http\Request;

trait Configurable
{
    protected static $config = [];

    public static function variables(Request $request)
    {
        return array_merge(static::getConfig($request), [
            'base' => config('admin.route.prefix'),
            'user' => static::user(),
        ]);
    }

    public static function provideToScript($config)
    {
        static::$config[] = $config;

        return new static;
    }

    protected static function getConfig(Request $request)
    {
        if (empty(static::$config)) {
            return [];
        }

        return array_merge(...collect(static::$config)->map(function($config) use ($request) {
            if (is_callable($config)) {
                $config = call_user_func($config, $request);
            }

            return $config;
        })->toArray());
    }
}
