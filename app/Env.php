<?php

namespace BVZ;

use Dotenv\Dotenv;

require_once __DIR__ . "/vendor/autoload.php";

class Env
{
    static $dotenv;

    const MAIL_HOST = "MAIL_HOST";
    const MAIL_PORT = "MAIL_PORT";
    const MAIL_PW = "MAIL_PW";
    const PROFILE = "PROFILE";
    const DB_HOST = "DB_HOST";
    const DB_USER = "DB_USER";
    const DB_PW = "DB_PW";
    const DB_NAME = "DB_NAME";
    const DEV_PROFILE = "dev";
    const PRODUCTION_PROFILE = "production";

    static function init()
    {
        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->safeLoad();
    }

    static function get(string $key)
    {
        if (Env::$dotenv == null) {
            Env::init();
        }
        return $_ENV[$key];
    }
}
