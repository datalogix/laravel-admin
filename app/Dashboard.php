<?php

namespace App;

use Datalogix\Admin\Tool;

class Dashboard extends Tool
{
    public function boot()
    {
        $this->style('foo', __DIR__ . '/foo.css');
        $this->script('foo', __DIR__ . '/foo.js');
    }

    public function navigation()
    {
        return view('test');
    }
}
