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

    @javascript
    Scenario: Run chef-client to create attributes
      Given I run chef-client
      When I reload the page
      Then the "#attributes-default span.attribute-name" element should contain "test-cookbook"

    @javascript
    Scenario: Open the attribute tree
      When I open the tree leaf "1" of the "default" panel
      Then the "test-cookbook[attribute1]" field should contain "value-default-attribute1"

    @javascript
    Scenario: Edit "attribute1"
      When I fill in "test-cookbook[attribute1]" with "new attribute1 value"
      When I press "Save node"
      When I open the tree leaf "1" of the "default" panel
      Then the "test-cookbook[attribute1]" field should contain "new attribute1 value"

