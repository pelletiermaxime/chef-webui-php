@domain
@roles
Feature: Edit roles
    I should be able to edit a role, it's runlist and it's attributes

    Scenario: Edit role "test-role-1"
      When I edit the role "test-role-1" with description "Nouvelle description rôle 1"
      Then I should see the message "Role saved successfully."
        And a role named "test-role-1" with description "Nouvelle description rôle 1" should exists

    Scenario: Edit invalid role "test-invalid-role"
      When I edit the invalid role "test-invalid-role"
      Then I should see the message 'Invalid role "test-invalid-role".'

