@domain
@roles
Feature: delete role
    I should be able to delete a role

    Scenario: Delete role "test-role-1"
      When I delete the role "test-role-1"
      Then I should see the message "Role test-role-1 deleted."
        And a role named "test-role-1" should not exists
