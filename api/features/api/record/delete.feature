@api @record @delete
Feature: Delete records

  Background:
    Given I am authenticated as the "system@system.ds" user from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Delete a record
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/records/88d90364-c6be-4dac-8fa4-7e4d43d08eea"
    Then the response status code should be 204
    And the response should be empty

  Scenario: Read the deleted record
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/records/88d90364-c6be-4dac-8fa4-7e4d43d08eea"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/json"

  Scenario: Delete a deleted record
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/records/88d90364-c6be-4dac-8fa4-7e4d43d08eea"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/json"
