<?php

return [
    'enabled' => env('BLADE_MINIFY_ENABLED', false),

    'options' => [
        'cssMinifier' => [\Minify_CSSmin::class, 'minify'],
        'jsMinifier' => [\JSMin\JSMin::class, 'minify'],
    ],
];
