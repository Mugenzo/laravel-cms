<?php

return [
    'site_title' => env('SITE_TITLE', config('app.name')),
    'site_description' => env('SITE_DESCRIPTION', ''),
    'per_page' => env('PER_PAGE', 10)
];
