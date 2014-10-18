<?php
trait BootstrapLaravel
{
     /**
    * @static
    * @beforeSuite
    */
    public static function bootstrapLaravel()
    {
        if (!defined('LARAVEL_START')) {
            $unitTesting = true;
            $testEnvironment = 'testing';
            require __DIR__.'/../../../bootstrap/autoload.php';
            $app = require_once __DIR__.'/../../../bootstrap/start.php';
            $app->boot();
        }
    }
}

