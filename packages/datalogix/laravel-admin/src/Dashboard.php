<?php

namespace Datalogix\Admin;

class Dashboard extends Tool
{
    public function navigation()
    {
        return view('admin::dashboard.navigation');
    }
}
