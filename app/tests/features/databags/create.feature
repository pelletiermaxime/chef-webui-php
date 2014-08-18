Feature: Create databags and databags items
    I should be able to create databags with their name
    and databag items with their id

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

    Scenario: Create invalid databag item "test databag item 1"
      Given I am on homepage
      When I follow "Databags"
      When I follow "test-databag-1"
      When I follow "Create"
      When I fill in "id" with "test databag item 1"
      When I press "Save"
      Then I should be on "/databags/create/test-databag-1"
        And I should see "The id format is invalid."

    Scenario: Create valid databag item "test-databag-item-1"
      Given I am on homepage
      When I follow "Databags"
      When I follow "test-databag-1"
      When I follow "Create"
      When I fill in "id" with "test-databag-item-1"
      When I press "Save"
      Then I should be on "/databags/test-databag-1"
        And I should see "test-databag-item-1"
