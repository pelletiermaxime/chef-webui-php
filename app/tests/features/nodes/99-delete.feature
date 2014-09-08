Feature: Delete node
  I should be able to delete nodes

  Scenario: Delete node "test-node-1"
    Given I am on homepage
    When I follow "Nodes"
    When I follow "Delete"
    Then I should be on "/nodes"
      And I should see "Node test-node-1 deleted."

