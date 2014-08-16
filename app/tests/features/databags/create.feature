Feature: Create databags
    I should be able to create databags with their name

    Context:

    Scenario: Create invalid databag "test databag 1"
      Given I am on homepage
      When I follow "Databags"
      When I follow "Create"
      When I fill in "name" with "test databag 1"
      When I press "Save"
      Then I should be on "/databags/create"
        And I should see "The name format is invalid."

    Scenario: Create valid databag "test-databag-1"
      Given I am on homepage
      When I follow "Databags"
      When I follow "Create"
      When I fill in "name" with "test-databag-1"
      When I press "Save"
      Then I should be on "/databags"
        And I should see "test-databag-1"

