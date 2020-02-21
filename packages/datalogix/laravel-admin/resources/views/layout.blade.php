<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title -->
    <title>{{ config('admin.title') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">

    <!-- Tool Styles -->
    @foreach ($styles as $name => $path)
        @if (Str::startsWith($path, ['http://', 'https://']))
            <link href="{!! $path !!}" rel="stylesheet">
        @else
            <link href="{{ route('admin.style', $name) }}" rel="stylesheet">
        @endif
    @endforeach
</head>
<body>
    <div id="app">
        <v-app>
            @include('admin::partials.navbar')
            @include('admin::partials.navigation')
            @include('admin::partials.content')
        </v-app>
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/manifest.js', 'admin') }}"></script>
    <script src="{{ mix('js/vendor.js', 'admin') }}"></script>
    <script src="{{ mix('js/app.js', 'admin') }}"></script>

    <!-- Build Admin -->
    <script>
        window.Admin = new LaravelAdmin(@json($variables))
    </script>

    <!-- Tool Sripts -->
    @foreach ($scripts as $name => $path)
        @if (Str::startsWith($path, ['http://', 'https://']))
            <script src="{!! $path !!}"></script>
        @else
            <script src="{{ route('admin.script', $name) }}"></script>
        @endif
    @endforeach

    <!-- Init Admin -->
    <script>
        Admin.init()
    </script>
</body>
</html>
