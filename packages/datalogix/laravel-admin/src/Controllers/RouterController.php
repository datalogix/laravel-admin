<?php

namespace Datalogix\Admin\Controllers;

use Datalogix\Admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RouterController extends Controller
{
    public function getScript(Request $request, $script)
    {
        $content = Admin::getScript($request, $script);

        return response($content)->header('Content-Type', 'text/javascript');
    }

    public function getStyle(Request $request, $style)
    {
        $content = Admin::getStyle($request, $style);

        return response($content)->header('Content-Type', 'text/css');
    }

    public function router()
    {
        return view('admin::router');
    }
}
