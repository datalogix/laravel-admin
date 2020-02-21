<?php

namespace Datalogix\Admin\Tools;

use Datalogix\Admin\Tool;

class Dashboard extends Tool
{
    public function navigation()
    {
        return view('admin::dashboard.navigation');
    }
}
