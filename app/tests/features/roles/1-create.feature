@domain
@roles
Feature: Create roles
    I should be able to create a role

    Scenario: Create invalid role
      When I create a role with name "2 words"
      Then I should see the message "The name format is invalid."

    Scenario: Create valid role "test-role-1"
      When I create a role with name "test-role-1" and description "Description rôle 1"
      Then I should see the message "Role saved successfully."
        And a role named "test-role-1" with description "Description rôle 1" should exists

    Scenario: Create duplicate role "test-role-1"
      When I create a role with name "test-role-1"
      Then I should see the message 'Error saving: Role "test-role-1" already exists.'

    @cleanup
    Scenario: Edit role "test-role-1"
      When I edit the role "test-role-1" with description "Nouvelle description rôle 1"
      Then I should see the message "Role saved successfully."
        And a role named "test-role-1" with description "Nouvelle description rôle 1" should exists

