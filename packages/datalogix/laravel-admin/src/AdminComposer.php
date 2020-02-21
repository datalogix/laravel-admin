<?php

namespace Datalogix\Admin;

use Illuminate\View\View;

class AdminComposer
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
