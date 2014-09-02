Feature: Create node
    I should be able to create a node with only their name

    @wip
    @nodes
    Scenario: Create invalid node "test node 1"
      Given I am on homepage
      When I follow "Nodes"
      When I follow "Create"
      When I fill in "name" with "test node 1"
      When I press "Save"
      Then I should be on "/nodes/create"
        And I should see "The name format is invalid."

    @nodes
    Scenario: Create valid node "test-node-1"
      Given I am on homepage
      When I follow "Nodes"
      When I follow "Create"
      When I fill in "name" with "test-node-1"
      When I press "Save"
      Then I should be on "/nodes"
        And I should see "test-node-1"
