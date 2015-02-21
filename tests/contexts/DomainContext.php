<?php

use Behat\Behat\Tester\Exception\PendingException;

/**
 * Behat context class.
 */
class DomainContext extends BaseDomainContext
{
    private $messages;
    private $role;

    public function __construct()
    {
    }

    /**
      * @AfterScenario @cleanup
      */
    public function cleanupRoles()
    {
        $roles = Role::all();
        foreach ($roles as $role => $url) {
            Role::destroy($role);
        }
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
        $this->role               = new Role;
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

    /**
     * @When I edit the role :name with description :description
     */
    public function iEditTheRoleWithDescription($name, $new_description)
    {
        $this->role               = Role::find($name);
        $this->role->description  = $new_description;
        $this->role->save();
    }

    /**
     * @When I edit the invalid role :name
     */
    public function iEditTheInvalidRole($name)
    {
        $this->role = Role::find($name);
    }

    /**
     * @When I delete the role :name
     */
    public function iDeleteTheRole($name)
    {
        $this->role = Role::find($name);
        $this->role->delete($name);
    }

    /**
     * @Then a role named :name should not exists
     */
    public function aRoleNamedShouldNotExists($name)
    {
        $role = Role::find($name);
        //If not found $role will only countain an error message
        PHPUnit_Framework_Assert::assertNull($role->name);
        PHPUnit_Framework_Assert::assertNull($role->description);
        PHPUnit_Framework_Assert::assertCount(1, $role->messages);
    }
}
