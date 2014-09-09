Feature: Runlist management for nodes
    I should be able to modify the runlist of a node

    @nodes
    @javascript
    Scenario: Set runlist for node "test-node-1"
      Given I am on homepage
      When I follow "Nodes"
      When I follow "test-node-1"
      When I drag "test-cookbook" into the run_list
      When I press "Save node"
      Then I should be on "/nodes/test-node-1"
        And I should see "Node saved."
        And the ".run-list .available_recipe" element should contain "test-cookbook"
