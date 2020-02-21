<?php

namespace Datalogix\Admin\Traits;

use Illuminate\Http\Request;

trait Boot
{
    protected static $bootingCallbacks = [];

    protected static $bootedCallbacks = [];

    public static function booting(callable $callback)
    {
        static::$bootingCallbacks[] = $callback;

        return new static;
    }

    public static function booted(callable $callback)
    {
        static::$bootedCallbacks[] = $callback;

        return new static;
    }

    public static function bootstrap(Request $request)
    {
        static::fireBootingCallbacks($request);

        if (file_exists($bootstrap = config('admin.bootstrap'))) {
            require $bootstrap;
        }

        static::fireBootedCallbacks($request);
    }

    protected static function fireBootingCallbacks(Request $request)
    {
        foreach (static::$bootingCallbacks as $callable) {
            call_user_func($callable, $request);
        }
    }

    protected static function fireBootedCallbacks(Request $request)
    {
        foreach (static::$bootedCallbacks as $callable) {
            call_user_func($callable, $request);
        }
    }
}
