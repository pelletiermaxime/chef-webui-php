<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\SnippetAcceptingContext;
// use Behat\Gherkin\Node\PyStringNode;
// use Behat\Gherkin\Node\TableNode;

use Behat\MinkExtension\Context\MinkContext;

/**
 * Behat context class.
 */
// class FeatureContext implements SnippetAcceptingContext
class BaseContext extends MinkContext implements SnippetAcceptingContext
{
     /**
    * @static
    * @beforeSuite
    */
    public static function bootstrapLaravel()
    {
        $unitTesting = true;
        $testEnvironment = 'testing';
        require __DIR__.'/../../../bootstrap/autoload.php';
        $app = require_once __DIR__.'/../../../bootstrap/start.php';
        $app->boot();
    }

    /**
    * Take screenshot when step fails.
    * Works only with javascript drivers.
    *
    * @AfterStep
    */
    public function takeScreenshotAfterFailedStep($event)
    {
        if ($event->getTestResult()->hasException()) {
            $this->showLastResponse();
        }
    }
}
