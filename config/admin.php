<?php

return [
    'tools' => [
        App\Dashboard::class,

        (new App\Dashboard)->canSee(function ($request) {
            return false;
        })
    ]
];
