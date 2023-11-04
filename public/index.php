<?php

use core\ViewHelper;

# Define the base directory path
const BASE_PATH = __DIR__ . "/../";

# Require general functions script
require BASE_PATH . "core/functions.php";

# Require controllers
require controller('IndexController.php');

# Start or renew the session
session_start();

# Get the routes and sites uri
$routes = require base_path('routes.php');
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
# Router
try {
    if (isset($routes[$uri][$method])) {
        $action = $routes[$uri][$method];
        $action[0] = 'controller\\' . $action[0];
        call_user_func($action);
    } else {
        // Option: return here 404 status code
        # echo "No controller for $uri and method $method";
        ViewHelper::abort("404");
    }
}  catch (Exception $e) {
    // If an exception occurred here, there is an internal issue
    // Return 400 status code and display the message
    ViewHelper::abort("400", $e);
} finally {
    exit();
}
