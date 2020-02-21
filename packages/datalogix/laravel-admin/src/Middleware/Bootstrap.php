<?php

namespace Datalogix\Admin\Middleware;

use Closure;
use Datalogix\Admin\Admin;
use Illuminate\Http\Request;

class Bootstrap
{
    public function handle(Request $request, Closure $next)
    {
        if (Admin::guard()->check()) {
            Admin::bootstrap($request);
        }

        return $next($request);
    }
}
