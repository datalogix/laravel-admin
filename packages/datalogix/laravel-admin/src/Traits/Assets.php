<?php

namespace Datalogix\Admin\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

trait Assets
{
    protected static $scripts = [];
    protected static $styles = [];

    public static function script($name, $file)
    {
        static::$scripts[$name] = $file;

        return new static;
    }

    public static function style($name, $file)
    {
        static::$styles[$name] = $file;

        return new static;
    }

    public static function availableScripts(Request $request)
    {
        return static::$scripts;
    }

    public static function availableStyles(Request $request)
    {
        return static::$styles;
    }

    public static function getScript(Request $request, $script)
    {
        $scripts = static::availableScripts($request);

        return File::get($scripts[$script]);
    }

    public static function getStyle(Request $request, $style)
    {
        $styles = static::availableStyles($request);

        return File::get($styles[$style]);
    }
}
