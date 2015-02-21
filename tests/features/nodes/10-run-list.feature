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

    @nodes
    @javascript
    Scenario: Set role runlist for node "test-node-1"
      Given I create a role with name "test-role-runlist" and description "Description rôle 1"
      And I am on homepage
      When I follow "Nodes"
      When I follow "test-node-1"
      When I drag "test-role-runlist" into the role run_list
      When I press "Save node"
      Then I should be on "/nodes/test-node-1"
        And I should see "Node saved."
        And the ".run-list .available_recipe" element should contain "test-cookbook"
        And the ".run-list .available_role" element should contain "test-role-runlist"

    @nodes
    @javascript
    Scenario: Clear runlist for node "test-node-1"
      Given I am on homepage
      When I follow "Nodes"
        And I follow "test-node-1"
        And I drag "test-cookbook" out of the run_list
        And I drag "test-role-runlist" out of the role run_list
      When I press "Save node"
      Then I should be on "/nodes/test-node-1"
        And I should see "Node saved."
        And I should not see a ".run-list .available_recipe" element
        And I should not see a ".run-list .available_role" element
        And the ".available_recipes .available_recipe" element should contain "test-cookbook"
