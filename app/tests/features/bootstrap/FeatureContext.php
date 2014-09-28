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
        $app = require_once __DIR__.'/../../../../bootstrap/start.php';
        $app->boot();
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
        Cookbooks::create($name, $version);
    }

    /**
     * @When I drag :recipe into the run_list
     */
    public function iDragIntoTheRunList($recipe)
    {
        $session = $this->getSession();
        // $page = $session->getPage();
        // $el1 = $page->find('xpath', "//p[text()='$recipe']/..");
        // $el1 = $page->find('xpath', "//p[text()='$recipe']")->getParent();
        // $el1 = $page->find('css', ".available_recipe");
        // $el2 = $page->findById('panel-available-run-list');
        // $el2 = $page->find('css', '.run-list');
        // $el2 = $page->find('xpath', '//*[@id="panel-available-run-list"]');

        // $el1->dragTo($el2);

        $session->executeScript("$('#run_list').val('$recipe');");
    }

    /**
     * @When I drag :recipe out of the run_list
     */
    public function iDragOutOfTheRunList($recipe)
    {
        $session = $this->getSession();
        $session->executeScript("$('#run_list').val('');");
        // $page = $session->getPage();
        // $el1 = $page->find('xpath', "//p[text()='$recipe']")->getParent();
        // $el2 = $page->findById('panel-available-recipes');
        // $el1->dragTo($el2);
    }

    /**
     * @Given I run chef-client
     */
    public function iRunChefClient()
    {
        exec('bundle exec chef-client --config app/tests/client.rb');
        Cache::forget("node-test-node-1");
    }

    /**
     * @When I open the tree leaf :leaf_number of the :panel_id panel
     */
    public function iOpenTheTreeLeafOfThePanel($leaf_number, $panel_id)
    {
        $treeNumber = ['override' => 1, 'default' => 2, 'normal' => 3];
        $session = $this->getSession();
        $leaf = "j{$treeNumber[$panel_id]}_$leaf_number";
        $open_node = "$('#attributes-$panel_id .jstree').jstree().open_node('$leaf');";
        $session->executeScript($open_node);
    }
}
