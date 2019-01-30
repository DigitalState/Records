@api @security @firewall @metadata
Feature: Deny access to non-authenticated users to metadata endpoints

  Scenario: Browse metadata
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/metadata"
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Read a metadata
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/metadata/4d4354b9-6069-44c3-9eac-c876a5a90e7f"
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Add a metadata
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "POST" request to "/metadata" with body:
    """
    {}
    """
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Edit a metadata
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/metadata/4d4354b9-6069-44c3-9eac-c876a5a90e7f" with body:
    """
    {}
    """
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Delete a metadata
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/metadata/4d4354b9-6069-44c3-9eac-c876a5a90e7f"
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON