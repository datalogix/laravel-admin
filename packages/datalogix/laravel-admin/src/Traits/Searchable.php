<?php

namespace Datalogix\Admin\Traits;

use Illuminate\Http\Request;

trait Searchable
{
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
