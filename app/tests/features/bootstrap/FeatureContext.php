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
class FeatureContext extends MinkContext implements SnippetAcceptingContext
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context object.
     * You can also pass arbitrary arguments to the context constructor through behat.yml.
     */
    public function __construct()
    {
    }

     /**
    * @static
    * @beforeSuite
    */
    public static function bootstrapLaravel()
    {
        $unitTesting = true;
        $testEnvironment = 'testing';
        require __DIR__.'/../../../../bootstrap/autoload.php';
        require_once __DIR__.'/../../../../bootstrap/start.php';
        // require app_path().'/models/Cookbooks.php';
    }

     /**
    * Take screenshot when step fails.
    * Works only with Selenium2Driver.
    *
    * @AfterStep
    */
    public function takeScreenshotAfterFailedStep($event)
    {
        if ($event->getTestResult()->hasException()) {
            $this->showLastResponse();
        }
    }

    /**
     * @Given I create the cookbook :name with version :version
     */
    public function iCreateTheCookbookWithVersion($name, $version)
    {
        throw new PendingException();
        // $cookbook = new Cookbooks();
        // $cookbook->create($name, $version);
    }
}
