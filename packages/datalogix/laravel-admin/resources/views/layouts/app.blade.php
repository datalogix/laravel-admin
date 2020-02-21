@extends('admin::layouts.base')

@section('styles')
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.css" rel="stylesheet">
    <link href="{{ mix('css/app.css', 'admin') }}" rel="stylesheet">

    <!-- Tool Styles -->
    @foreach ($styles as $name => $path)
        @if (Str::startsWith($path, ['http://', 'https://']))
            <link href="{!! $path !!}" rel="stylesheet">
        @else
            <link href="{{ route('admin.style', $name) }}" rel="stylesheet">
        @endif
    @endforeach
@endsection

@section('body')
    <div id="app">
        <v-app>
            @include('admin::partials.navbar')
            @include('admin::partials.navigation')
            @include('admin::partials.content')
        </v-app>
    </div>
@endsection

@section('scripts')
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
@endsection
