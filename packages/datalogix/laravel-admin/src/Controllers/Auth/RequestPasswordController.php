<?php

namespace Datalogix\Admin\Controllers\Auth;

use Datalogix\Admin\Auth\SendsPasswordResetEmails;
use Illuminate\Routing\Controller;

class RequestPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;
}
