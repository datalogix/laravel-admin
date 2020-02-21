<?php

namespace Datalogix\Admin\Middleware;

use Closure;
use Datalogix\Admin\Admin;
use Illuminate\Http\Request;

class Authenticate
{
    public function handle(Request $request, Closure $next)
    {
        $redirectTo = admin_base_path(config('admin.auth.redirect_to'));

        if (Admin::guard()->guest() && !$this->shouldPassThrough($request)) {
            return redirect()->guest($redirectTo);
        }

        return $next($request);
    }

    protected function shouldPassThrough(Request $request)
    {
        return collect(config('admin.auth.excepts'))
            ->map('admin_base_path')
            ->contains(function ($except) use ($request) {
                if ($except !== '/') {
                    $except = trim($except, '/');
                }
                return $request->is($except);
            });
    }
}
