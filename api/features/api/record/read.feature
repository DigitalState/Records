@api @record @read
Feature: Read records

  Background:
    Given I am authenticated as the "system@system.ds" user from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Read a record
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/records/88d90364-c6be-4dac-8fa4-7e4d43d08eea"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should exist
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should exist
    And the JSON node "uuid" should be equal to the string "88d90364-c6be-4dac-8fa4-7e4d43d08eea"
    And the JSON node "createdAt" should exist
    And the JSON node "updatedAt" should exist
    And the JSON node "deletedAt" should exist
    And the JSON node "deletedAt" should be null
    And the JSON node "owner" should exist
    And the JSON node "owner" should be equal to the string "BusinessUnit"
    And the JSON node "ownerUuid" should exist
    And the JSON node "ownerUuid" should be equal to the string "83bf8f26-7181-4bed-92f3-3ce5e4c286d7"
    And the JSON node "identity" should exist
    And the JSON node "identity" should be equal to the string "Individual"
    And the JSON node "identityUuid" should exist
    And the JSON node "identityUuid" should be equal to the string "9ce3bdb9-47e1-43c9-81ee-0dcc2106ba42"
    And the JSON node "title" should exist
    And the JSON node "title.en" should exist
    And the JSON node "title.en" should be equal to "Animal License Form Submission"
    And the JSON node "title.fr" should exist
    And the JSON node "title.fr" should be equal to "Formulaire de soumission pour permis animalier"
    And the JSON node "data" should exist
    And the JSON node "data.type" should exist
    And the JSON node "data.type" should be equal to "dog"
    And the JSON node "associations" should exist
    And the JSON node "associations" should have 0 elements
    And the JSON node "version" should exist
    And the JSON node "version" should be equal to the number 1
    And the JSON node "tenant" should exist
    And the JSON node "tenant" should be equal to "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"
