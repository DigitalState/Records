@api @security @firewall @record
Feature: Deny access to non-authenticated users to record endpoints

  Scenario: Browse records
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/records"
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Read a record
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/records/88d90364-c6be-4dac-8fa4-7e4d43d08eea"
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Add a record
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "POST" request to "/records" with body:
    """
    {}
    """
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Edit a record
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/records/88d90364-c6be-4dac-8fa4-7e4d43d08eea" with body:
    """
    {}
    """
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Delete a record
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/records/88d90364-c6be-4dac-8fa4-7e4d43d08eea"
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON