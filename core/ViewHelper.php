<?php

namespace core;

class ViewHelper
{
    // Displays a given view and sets the $variables array into scope.
    public static function render($file, $variables = []): void
    {
        extract($variables);
        require \base_path("view/" . $file);
    }

    // Redirects to the given URL
    public static function redirect($url): void
    {
        header("Location: " . $url);
    }

    public static function abort($code = 404, $message = ""): void
    {
        http_response_code($code);

        require \base_path("view/{$code}.php");
    }
}