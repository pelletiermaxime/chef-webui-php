Feature: List cookbooks
    I should be able to see a list of all the cookbooks

    @cookbooks
    Scenario: Create test cookbook "test cookbook 0.1"
      Given I create the cookbook "test-cookbook" with version "0.1"
        And I am on homepage
      When I follow "Cookbooks"
      Then I should see "test-cookbook"
        And I should see "0.1"
