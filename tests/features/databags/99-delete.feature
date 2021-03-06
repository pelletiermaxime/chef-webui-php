Feature: Delete databags
  I should be able to delete databags

  Scenario: Delete databag item "test-databag-item-1"
    Given I am on homepage
    When I follow "Databags"
    When I follow "test-databag-1"
    When I follow "Delete"
    Then I should be on "/databags/test-databag-1"
      And I should see "Databag test-databag-item-1 deleted."

  Scenario: Delete databag "test-databag-1"
    Given I am on homepage
    When I follow "Databags"
    When I follow "Delete"
    Then I should be on "/databags"
      And I should see "Databag test-databag-1 deleted."

