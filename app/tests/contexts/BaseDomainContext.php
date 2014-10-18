<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\SnippetAcceptingContext;
// use Behat\Gherkin\Node\PyStringNode;
// use Behat\Gherkin\Node\TableNode;

/**
 * Behat context class.
 */
 class BaseDomainContext implements SnippetAcceptingContext
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
