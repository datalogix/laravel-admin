<?php

namespace Datalogix\Admin;

use Closure;
use Illuminate\Http\Request;

trait CanSee
{
    private $canSee = true;

    public function canSee(Closure $closure)
    {
        $this->canSee = $closure;

        return $this;
    }

    public function callCanSee(Request $request)
    {
        $canSee = $this->canSee;

        if ($canSee instanceof Closure) {
            $canSee = $canSee($request);
        }

        return $canSee;
    }
}
