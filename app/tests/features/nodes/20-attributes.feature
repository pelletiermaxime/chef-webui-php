Feature: Attributes management for nodes
    I should be able to see, edit and delete node attributes

    @nodes
    @javascript
    Scenario: Set runlist for node "test-node-1"
      Given I am on homepage
      When I follow "Nodes"
      When I follow "test-node-1"
      When I drag "test-cookbook" into the run_list
      When I press "Save node"
      Then I should be on "/nodes/test-node-1"

    Scenario: Run chef-client to create attributes
      Given I run chef-client
