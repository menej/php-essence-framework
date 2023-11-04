<?php

namespace controller;

require base_path('core/ViewHelper.php');

use core\ViewHelper;

class IndexController
{
    public static function index(): void
    {
        $variables = ["title" => "Home"];
        ViewHelper::render('index.view.php', $variables);
    }
}