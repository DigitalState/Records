@api @access @edit
Feature: Edit accesses

  Background:
    Given I am authenticated as the "system@system.ds" user from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Edit an access
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/accesses/d332f180-3d5a-4efc-9983-b0e9ca27a363" with body:
    """
    {
      "owner": "System",
      "ownerUuid": "aa18b644-a503-49fa-8f53-10f4c1f8e3a1",
      "assignee": "System",
      "assigneeUuid": "aa18b644-a503-49fa-8f53-10f4c1f8e3a1",
      "version": 1
    }
    """
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "owner" should be equal to the string "System"
    And the JSON node "ownerUuid" should be equal to the string "aa18b644-a503-49fa-8f53-10f4c1f8e3a1"
    And the JSON node "assignee" should be equal to the string "System"
    And the JSON node "assigneeUuid" should be equal to the string "aa18b644-a503-49fa-8f53-10f4c1f8e3a1"
    And the JSON node "version" should be equal to the number 2

  Scenario: Confirm the edited access
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/accesses/d332f180-3d5a-4efc-9983-b0e9ca27a363"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "owner" should be equal to the string "System"
    And the JSON node "ownerUuid" should be equal to the string "aa18b644-a503-49fa-8f53-10f4c1f8e3a1"
    And the JSON node "assignee" should be equal to the string "System"
    And the JSON node "assigneeUuid" should be equal to the string "aa18b644-a503-49fa-8f53-10f4c1f8e3a1"
    And the JSON node "version" should be equal to the number 2

  Scenario: Edit an access's read-only properties
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/accesses/d332f180-3d5a-4efc-9983-b0e9ca27a363" with body:
    """
    {
      "id": 9999,
      "uuid": "1ac1b01e-4934-4b89-8a43-7d17a849be61",
      "createdAt":"2000-01-01T12:00:00+00:00",
      "updatedAt":"2000-01-01T12:00:00+00:00",
      "version": 2,
      "tenant": "93377748-2abb-4e33-9027-5d8a5c281a41"
    }
    """
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should be equal to the string "d332f180-3d5a-4efc-9983-b0e9ca27a363"
    And the JSON node "createdAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "updatedAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "tenant" should be equal to "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Confirm the unedited access
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/accesses/d332f180-3d5a-4efc-9983-b0e9ca27a363"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should be equal to the string "d332f180-3d5a-4efc-9983-b0e9ca27a363"
    And the JSON node "createdAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "updatedAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "tenant" should be equal to "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Edit an access with an invalid optimistic lock
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/accesses/d332f180-3d5a-4efc-9983-b0e9ca27a363" with body:
    """
    {
      "ownerUuid": "8a1e280b-cd3b-4c1e-be62-f2e74b77e350",
      "version": 1
    }
    """
    Then the response status code should be 500
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON
