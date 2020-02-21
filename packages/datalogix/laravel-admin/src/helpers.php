<?php

if (!function_exists('admin_path')) {
    function admin_path($path = '') {
        return config('admin.directory').($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}

if (!function_exists('admin_url')) {
    function admin_url($path = '', $parameters = [], $secure = null) {
        if (\Illuminate\Support\Facades\URL::isValidUrl($path)) {
            return $path;
        }

        $secure = $secure ?: config('admin.https');

        return url(admin_base_path($path), $parameters, $secure);
    }
}

if (!function_exists('admin_base_path')) {
    function admin_base_path($path = '') {
        $prefix = '/' . trim(config('admin.route.prefix'), '/');
        $prefix = ($prefix == '/') ? '' : $prefix;
        $path = trim($path, '/');

        if (is_null($path) || strlen($path) === 0) {
            return $prefix ?: '/';
        }

        return $prefix . '/' . $path;
    }
}

if (!function_exists('admin_asset')) {
    function admin_asset($path) {
        return config('admin.https') ? secure_asset($path) : asset($path);
    }
}
