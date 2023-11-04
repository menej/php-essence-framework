<?php

namespace controller;

require base_path('core/ViewHelper.php');
require_once base_path("model/DBInit.php");

use core\ViewHelper;
use model\DBInit;

class IndexController
{
    public static function index(): void
    {

        DBInit::getInstance();

        $variables = ["title" => "Home"];
        ViewHelper::render('index.view.php', $variables);
    }
}