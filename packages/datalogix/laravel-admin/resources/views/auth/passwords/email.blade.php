@extends('admin::layouts.auth')

@section('content')
    <form method="post" action="{{ route('admin.password.email') }}" novalidate>
        @csrf
        <div class="flex flex-column">
            <label for="email">{{ __('admin::general.email') }}:</label>
            <input class="field" type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        </div>
        <button class="btn btn-success btn-block" type="submit">{{ __('admin::general.send') }}</button>
        <br>
        <div class="text-center"><a href="{{ route('admin.login') }}">{{ __('admin::general.back') }}</a></div>
    </form>
@endsection
