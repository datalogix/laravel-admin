@extends('admin::layouts.base')

@section('styles')
    <link href="{{ mix('css/auth.css', 'admin') }}" rel="stylesheet">
@endsection

@section('body')
    <div class="auth">
        <h1 class="text-center">
            @if (File::exists(public_path(config('admin.logo'))))
                <img src="{{ asset(config('admin.logo')) }}" alt="{{ config('admin.name') }}" />
            @else
                {{ config('admin.name') }}
            @endif
        </h1>
        <div class="content">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
@endsection
