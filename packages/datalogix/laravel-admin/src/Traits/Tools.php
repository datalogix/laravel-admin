<?php

namespace Datalogix\Admin\Traits;

use Datalogix\Admin\Tool;
use Illuminate\Http\Request;

trait Tools
{
    protected static $tools = [];
    protected static $availableTools = null;

    public static function tools(array $tools = [])
    {
        static::$tools = array_merge(static::$tools, $tools);

        return new static;
    }

    public static function availableTools(Request $request)
    {
        if (is_null(static::$availableTools)) {
            static::$availableTools = collect(static::$tools)->map(function ($tool) {
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
}
