<?php

/**
 * @param string $key
 * @return string|null
 */
function setting(string $key): null|string
{
    $value = \App\Models\Setting::query()->whereKey($key)->first();

    return $value || null;
}
