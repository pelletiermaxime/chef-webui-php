<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\SnippetAcceptingContext;

/**
 * Behat context class.
 */
class DomainContext extends BaseDomainContext
{
    private $messages;
    private $role;

    public function __construct()
    {
        $this->role = new Role;
    }

    /**
      * @AfterScenario @cleanup
      */
    public function cleanDB()
    {
        $this->role->delete();
    }

    /**
     * @When I create a role with name :arg1
     */
    public function iCreateARoleWithName($arg1)
    {
        return $this->iCreateARoleWithNameAndDescription($arg1, '');
    }

    /**
     * @Then I should see the message :arg1
     */
    public function iShouldSeeTheMessage($message)
    {
        PHPUnit_Framework_Assert::assertContains($message, $this->messages, print_r($this->messages, true));
    }

    /**
     * @When I create a role with name :arg1 and description :arg2
     */
    public function iCreateARoleWithNameAndDescription($name, $description)
    {
        $this->role->name         = $name;
        $this->role->description  = $description;
        $this->messages = $this->role->save();
    }

    /**
     * @Then a role named :arg1 with description :arg2 should exists
     */
    public function aRoleNamedWithDescriptionShouldExists($name, $description)
    {
        $role = Role::find($name);
        PHPUnit_Framework_Assert::assertEquals($description, $role->description);
    }
}
