<?php

namespace Datalogix\Admin\View;

use Datalogix\Admin\Admin;
use Illuminate\View\View;

class AppComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $request = request();

        $view->with([
            'user' => Admin::user(),
            'variables' => Admin::variables($request),
            'globalSearch' => Admin::availableGlobalSearch($request),
            'tools' => Admin::availableTools($request),
            'styles' => Admin::availableStyles($request),
            'scripts' => Admin::availableScripts($request),
        ]);
    }
}
