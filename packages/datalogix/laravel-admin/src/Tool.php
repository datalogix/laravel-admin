<?php

namespace Datalogix\Admin;

use Illuminate\Http\Request;

abstract class Tool
{
    public function boot()
    {
        //
    }

    public function navigation()
    {
        //
    }

    protected $canSeeCallback;

    public function canSee(callable $callback)
    {
        $this->canSeeCallback = $callback;

        return $this;
    }

    public function displayInNavigation(Request $request)
    {
        if (is_callable($this->canSeeCallback)) {
            return call_user_func($this->canSeeCallback, $request);
        }

        return true;
    }

    protected function script($name, $file)
    {
        Admin::script($name, $file);
    }

    protected function style($name, $file)
    {
        Admin::style($name, $file);
    }
}
