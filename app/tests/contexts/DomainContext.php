<?php

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
    public function cleanupRoles()
    {
        $this->role->delete();
    }

    /**
     * @When I create a role with name :arg1
     */
    public function iCreateARoleWithName($name)
    {
        return $this->iCreateARoleWithNameAndDescription($name, '');
    }

    /**
     * @Then I should see the message :arg1
     */
    public function iShouldSeeTheMessage($message)
    {
        PHPUnit_Framework_Assert::assertContains($message, $this->role->messages, print_r($this->role->messages, true));
    }

    /**
     * @When I create a role with name :arg1 and description :arg2
     * @param string $description
     */
    public function iCreateARoleWithNameAndDescription($name, $description)
    {
        $this->role->name         = $name;
        $this->role->description  = $description;
        $this->role->save();
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
