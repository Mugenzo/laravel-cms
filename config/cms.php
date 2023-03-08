<?php

return [
    'defaults' => [
        'site_title' => env('SITE_TITLE', config('app.name')),
        'site_description' => env('SITE_DESCRIPTION', ''),
        'per_page' => env('PER_PAGE', 10)
    ],

    'image_sizes' => [
        'thumbnail' => [150, 150],
        'small' => [300, 300],
        'medium' => [720, 480],
        'big' => [1280, 720]
    ]
];
