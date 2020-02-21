<?php

namespace Datalogix\Admin\Tools;

use Datalogix\Admin\Tool;

class Resources extends Tool
{
    protected $resources = [];

    public function __construct(array $resources = [])
    {
        $this->resources = $resources;
    }

    public function navigation()
    {
        $resources = $this->resources;

        return view('admin::resources.navigation', compact('resources'));
    }
}
