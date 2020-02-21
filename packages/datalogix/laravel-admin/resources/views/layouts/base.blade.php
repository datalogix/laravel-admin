<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ config('admin.loading') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title -->
    <title >{{ config('admin.title') }}</title>
    <style type="text/css">html,body{margin:0;padding:0;}</style>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">

    <!-- Styles -->
    @yield('styles')
</head>
<body>
    @yield('body')

    <!-- Scripts -->
    @yield('scripts')
</body>
</html>
