Feature: Delete databags
    I should be able to delete databags

    Context:

    Scenario: Delete databag "test-databag-1"
      Given I am on homepage
      When I follow "Databags"
      When I follow "Delete"
      Then I should be on "/databags"
        And I should see "Databag test-databag-1 deleted."

