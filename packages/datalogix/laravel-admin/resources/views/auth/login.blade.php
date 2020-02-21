@extends('admin::layouts.auth')

@section('content')
    <form method="post" action="{{ route('admin.login') }}" novalidate>
        @csrf
        <div class="flex flex-column">
            <label for="email">{{ __('admin::general.email') }}:</label>
            <input class="field" type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        </div>
        <div class="flex flex-column">
            <div class="flex justify-content-between">
                <label for="password">{{ __('admin::general.password') }}:</label>
                @if(config('admin.auth.reset_password'))
                    <a href="{{ route('admin.password.request') }}">{{ __('admin::general.reset_password') }}</a>
                @endif
            </div>
            <input class="field" type="password" id="password" name="password" required autocomplete="current-password">
        </div>
        <button class="btn btn-success btn-block" type="submit">{{ __('admin::general.login') }}</button>
        @if(config('admin.auth.remember'))
            <br>
            <div class="text-center">
                <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember">{{ __('admin::general.remember') }}</label>
            </div>
        @endif
    </form>
@endsection
