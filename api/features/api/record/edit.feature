@api @record @edit
Feature: Edit records

  Background:
    Given I am authenticated as the "system@system.ds" user from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Edit a record
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/records/88d90364-c6be-4dac-8fa4-7e4d43d08eea" with body:
    """
    {
      "title": {
        "en": "Animal License Form Submission - edit",
        "fr": "Formulaire de soumission pour permis animalier - edit"
      },
      "data": {
        "type": "dog - edit"
      },
      "version": 1
    }
    """
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "title.en" should be equal to "Animal License Form Submission - edit"
    And the JSON node "title.fr" should be equal to "Formulaire de soumission pour permis animalier - edit"
    And the JSON node "data.type" should be equal to "dog - edit"
    And the JSON node "version" should be equal to the number 2

  Scenario: Confirm the edited record
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/records/88d90364-c6be-4dac-8fa4-7e4d43d08eea"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "title.en" should be equal to "Animal License Form Submission - edit"
    And the JSON node "title.fr" should be equal to "Formulaire de soumission pour permis animalier - edit"
    And the JSON node "data.type" should be equal to "dog - edit"
    And the JSON node "version" should be equal to the number 2

  Scenario: Edit a record's read-only properties
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/records/88d90364-c6be-4dac-8fa4-7e4d43d08eea" with body:
    """
    {
      "id": 9999,
      "uuid": "023ef9b1-64e5-48cb-b367-6a4d09ad3161",
      "createdAt":"2000-01-01T12:00:00+00:00",
      "updatedAt":"2000-01-01T12:00:00+00:00",
      "deletedAt":"2000-01-01T12:00:00+00:00",
      "tenant": "40048804-8d66-4d48-b553-3833a5a06749"
    }
    """
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should be equal to the string "88d90364-c6be-4dac-8fa4-7e4d43d08eea"
    And the JSON node "createdAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "updatedAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "deletedAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "tenant" should be equal to "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Confirm the unedited record
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/records/88d90364-c6be-4dac-8fa4-7e4d43d08eea"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should be equal to the string "88d90364-c6be-4dac-8fa4-7e4d43d08eea"
    And the JSON node "createdAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "updatedAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "deletedAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "tenant" should be equal to "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Edit a record with an invalid optimistic lock
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/records/88d90364-c6be-4dac-8fa4-7e4d43d08eea" with body:
    """
    {
      "identityUuid": "d83ec028-0805-454f-b1bc-d0f658d1c41f",
      "version": 1
    }
    """
    Then the response status code should be 500
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON
