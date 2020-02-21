<?php

namespace Datalogix\Admin\Controllers;

use Datalogix\Admin\Admin;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Routing\Controller;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    protected $loginView = 'admin::auth.login';

    public function showLoginForm()
    {
        if ($this->guard()->check()) {
            return redirect($this->redirectPath());
        }

        return view($this->loginView);
    }

    protected function loggedOut()
    {
        return redirect($this->redirectTo());
    }

    protected function redirectTo()
    {
        return config('admin.route.prefix');
    }

    protected function guard()
    {
        return Admin::guard();
    }
}
