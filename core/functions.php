<?php

function base_path($path): string
{
    return BASE_PATH . $path;
}

/**
 * Function for help with importing controllers
 */
function controller($path): string
{
    return base_path('controller/' . $path);
}

/**
 * Function for the ease of debugging
 */
function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die();
}

