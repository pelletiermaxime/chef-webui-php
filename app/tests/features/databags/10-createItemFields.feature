Feature: Create databags items with custom fields
  I should be able to create databags item with custom fields

  Scenario: Create databag item "test-databag-item-fields"
    Given I am on homepage
    When I follow "Databags"
    When I follow "test-databag-1"
    When I follow "Create"
    Then I should see 2 ".add_field" element
    Then I should see 1 ".remove_field" element

  @javascript
  Scenario: Add a new field
    When I press "Add field"
    Then I should see an ".item_name" element
    Then I should see an ".item_value" element
    Then I should see 3 ".add_field" element
    Then I should see 2 ".remove_field" element

  @javascript
  Scenario: Add another new field and check the IDs and if it's empty
    When I fill in "item_name_1" with "Field name"
    And I fill in "item_value_1" with "Field value"
    And I press "Add field"
    Then the "item_name_2" field should contain ""
    And the "item_value_2" field should contain ""

  @javascript
  Scenario: Add another new field and check the IDs and if it's empty
    When I fill in "item_name_2" with "name"
    And I fill in "item_value_2" with "value"
    And I press "Add field"
    Then the "item_name_3" field should contain ""
    And the "item_value_3" field should contain ""

  @javascript
  Scenario: Delete the empty field
    When I press "remove_field_3"
    Then I should see 4 ".add_field" element
    Then I should see 3 ".remove_field" element

  @javascript
  Scenario: Save without mandatory ID field
    When I press "Save"
      Then I should be on "/databags/create/test-databag-1"
      And I should see "The id field is required."
      And the "item_name_1" field should contain "name"
      And the "item_value_1" field should contain "value"

  @javascript
  Scenario: Add an empty field and save the item with its fields
    When I fill in "id" with "test-databag-item-2"
    And I press "Add field"
    When I press "Save"
    Then I should be on "/databags/test-databag-1"
        And I should see "Databag item test-databag-item-2 saved."
