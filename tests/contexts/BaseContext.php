<?php

use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\MinkExtension\Context\MinkContext;

/**
 * Behat context class.
 */
class BaseContext extends MinkContext implements SnippetAcceptingContext
{
    use BootstrapLaravel;

    /**
    * Take screenshot when step fails.
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
