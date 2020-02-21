@extends('admin::layouts.auth')

@section('content')
    <form method="post" action="{{ route('admin.password.update') }}" novalidate>
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="flex flex-column">
            <label for="email">{{ __('admin::general.email') }}:</label>
            <input class="field" type="email" id="email" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
        </div>
        <div class="flex flex-column">
            <label for="password">{{ __('admin::general.password') }}:</label>
            <input class="field" type="password" id="password" name="password" required autocomplete="new-password">
        </div>
        <div class="flex flex-column">
            <label for="password_confirmation">{{ __('admin::general.password_confirmation') }}:</label>
            <input class="field" type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
        </div>
        <button class="btn btn-success btn-block" type="submit">{{ __('admin::general.change') }}</button>
        <br>
        <div class="text-center"><a href="{{ route('admin.login') }}">{{ __('admin::general.back') }}</a></div>
    </form>
@endsection
