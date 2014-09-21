Feature: Edit previously created databag item
  I should be able to add, modify and delete previously created databag item fields

  @javascript
  Scenario: Enter edit screen for databag item "test-databag-item-2"
    Given I am on homepage
    When I follow "Databags"
    When I follow "test-databag-1"
    When I follow "test-databag-item-2"
    Then I should be on "/databags/test-databag-1/item/test-databag-item-2"
      And the "id" field should contain "test-databag-item-2"
      And the "Field name" field should contain "Field value"
