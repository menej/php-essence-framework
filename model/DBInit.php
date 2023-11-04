<?php

namespace model;

use PDO;

class DBInit
{
    private static $host;
    private static $user;
    private static $password;
    private static $schema;
    private static $instance = null;

    public static function getInstance()
    {
        if (!self::$instance) {
            $db = require base_path('config/config.php');
            $db = $db['database'];

            self::$host = $db['host'];
            self::$user = $db['user'];
            self::$password = $db['password'];
            self::$schema = $db['schema'];

            $config = "mysql:host=" . self::$host
                . ";dbname=" . self::$schema;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_PERSISTENT => true,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            ];
            self::$instance = new PDO($config, self::$user, self::$password, $options);
        }
        return self::$instance;
    }


}