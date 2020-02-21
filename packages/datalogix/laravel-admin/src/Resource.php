<?php

namespace Datalogix\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

abstract class Resource
{
    protected static $title = null;
    protected static $subtitle = null;
    protected static $icon = null;
    protected static $group = null;
    protected static $uriKey = null;
    protected static $displayInNavigation = true;
    protected static $search = null;

    protected static function getTitle()
    {
        if (empty(static::$title)) {
            return Str::title(Str::snake(class_basename(static::class), ' '));
        }

        return static::$title;
    }

    public static function title()
    {
        return __(Str::plural(static::getTitle()));
    }

    public static function singularTitle()
    {
        return __(Str::singular(static::getTitle()));
    }

    public static function group()
    {
        if (empty(static::$group)) {
            return null;
        }

        return __(Str::title(static::$group));
    }

    public static function uriKey()
    {
        if (empty(static::$uriKey)) {
            return Str::kebab(class_basename(static::class));
        }

        return static::$uriKey;
    }

    public static function icon()
    {
        return static::$icon;
    }

    public static function subtitle()
    {
        return __(static::$subtitle);
    }

    public static function displayInNavigation(Request $request)
    {
        return static::$displayInNavigation;
    }

    public static function search()
    {
        return static::$search;
    }
}
