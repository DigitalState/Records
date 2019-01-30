@api @record @browse
Feature: Browse records

  Background:
    Given I am authenticated as the "system@system.ds" user from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Browse all records
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/records"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 2,
      "maxItems": 2,
      "items": {
        "type": "object",
        "properties": {
          "id": {
            "type": "integer"
          },
          "uuid": {
            "type": "string",
            "pattern": "[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}"
          },
          "createdAt": {
            "type": "string"
          },
          "updatedAt": {
            "type": "string"
          },
          "deletedAt": {
            "type": ["string", "null"]
          },
          "owner": {
            "type": "string"
          },
          "ownerUuid": {
            "type": "string",
            "pattern": "[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}"
          },
          "identity": {
            "type": "string"
          },
          "identityUuid": {
            "type": "string",
            "pattern": "[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}"
          },
          "title": {
            "type": "object"
          },
          "data": {
            "type": "object"
          },
          "associations": {
            "type": "array"
          },
          "version": {
            "type": "integer"
          },
          "tenant": {
            "type": "string",
            "pattern": "[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}"
          }
        }
      },
      "required": [
        "id",
        "uuid",
        "createdAt",
        "updatedAt",
        "deletedAt",
        "owner",
        "ownerUuid",
        "identity",
        "identityUuid",
        "title",
        "data",
        "associations",
        "version",
        "tenant"
      ]
    }
    """

  Scenario: Browse paginated records
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/records?_page=1&_limit=1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 1,
      "maxItems": 1
    }
    """

  Scenario: Browse records with a specific id
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/records?id=1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 1,
      "maxItems": 1
    }
    """

  Scenario: Browse records with specific ids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/records?id[0]=1&id[1]=2"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 2,
      "maxItems": 2
    }
    """

  Scenario: Browse records with a specific uuid
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/records?uuid=88d90364-c6be-4dac-8fa4-7e4d43d08eea"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 1,
      "maxItems": 1
    }
    """

  Scenario: Browse records with specific uuids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/records?uuid[0]=88d90364-c6be-4dac-8fa4-7e4d43d08eea&uuid[1]=077dc344-44e4-483a-8180-d992175bb441"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 2,
      "maxItems": 2
    }
    """

  Scenario: Browse records with a specific owner
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/records?owner=BusinessUnit"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 2,
      "maxItems": 2
    }
    """

  Scenario: Browse records with specific owners
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/records?owner[0]=BusinessUnit"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 2,
      "maxItems": 2
    }
    """

  Scenario: Browse records with a specific owner uuid
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/records?ownerUuid=83bf8f26-7181-4bed-92f3-3ce5e4c286d7"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 2,
      "maxItems": 2
    }
    """

  Scenario: Browse records with specific owner uuids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/records?ownerUuid[0]=83bf8f26-7181-4bed-92f3-3ce5e4c286d7"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 2,
      "maxItems": 2
    }
    """

  Scenario: Browse records with a specific identity
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/records?identity=Individual"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 1,
      "maxItems": 1
    }
    """

  Scenario: Browse records with specific identities
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/records?identity[0]=Individual&identity[1]=Organization"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 2,
      "maxItems": 2
    }
    """

  Scenario: Browse records with a specific identity uuid
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/records?identityUuid=9ce3bdb9-47e1-43c9-81ee-0dcc2106ba42"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 1,
      "maxItems": 1
    }
    """

  Scenario: Browse records with specific identity uuids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/records?identityUuid[0]=9ce3bdb9-47e1-43c9-81ee-0dcc2106ba42&identityUuid[1]=a6b3a00b-e732-4aeb-8011-a1e58fc7b5e3"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 2,
      "maxItems": 2
    }
    """

  Scenario: Browse records with a specific before created date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/records?createdAt[before]=2050-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 2,
      "maxItems": 2
    }
    """

  Scenario: Browse records with a specific after created date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/records?createdAt[after]=2000-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 2,
      "maxItems": 2
    }
    """

  Scenario: Browse records with a specific before updated date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/records?updatedAt[before]=2050-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 2,
      "maxItems": 2
    }
    """

  Scenario: Browse records with a specific after updated date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/records?updatedAt[after]=2000-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 2,
      "maxItems": 2
    }
    """

  Scenario: Browse records with a specific before deleted date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/records?deletedAt[before]=2050-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 0,
      "maxItems": 0
    }
    """

  Scenario: Browse records with a specific after deleted date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/records?deletedAt[after]=2000-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 0,
      "maxItems": 0
    }
    """

  Scenario: Browse records that has keywords for title
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/records?title=Animal"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 2,
      "maxItems": 2
    }
    """

  Scenario: Browse records that has record-insensitive keywords for title
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/records?title=animal"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 2,
      "maxItems": 2
    }
    """

  Scenario: Browse records ordered by id asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/records?order[id]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 2,
      "maxItems": 2
    }
    """

  Scenario: Browse records ordered by id desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/records?order[id]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 2,
      "maxItems": 2
    }
    """

  Scenario: Browse records ordered by created date asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/records?order[createdAt]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 2,
      "maxItems": 2
    }
    """

  Scenario: Browse records ordered by created date desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/records?order[createdAt]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 2,
      "maxItems": 2
    }
    """

  Scenario: Browse records ordered by updated date asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/records?order[updatedAt]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 2,
      "maxItems": 2
    }
    """

  Scenario: Browse records ordered by updated date desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/records?order[updatedAt]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 2,
      "maxItems": 2
    }
    """

  Scenario: Browse records ordered by deleted date asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/records?order[deletedAt]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 2,
      "maxItems": 2
    }
    """

  Scenario: Browse records ordered by deleted date desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/records?order[deletedAt]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 2,
      "maxItems": 2
    }
    """

  Scenario: Browse records ordered by owner asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/records?order[owner]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 2,
      "maxItems": 2
    }
    """

  Scenario: Browse records ordered by owner desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/records?order[owner]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 2,
      "maxItems": 2
    }
    """

#  Scenario: Browse records ordered by title asc
#    When I add "Accept" header equal to "application/json"
#    And I send a "GET" request to "/records?order[title]=asc"
#    Then the response status code should be 200
#    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
#    And the response should be in JSON
#    And the response should be a collection
#    And the response collection should count 2 items

#  Scenario: Browse records ordered by title desc
#    When I add "Accept" header equal to "application/json"
#    And I send a "GET" request to "/records?order[title]=desc"
#    Then the response status code should be 200
#    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
#    And the response should be in JSON
#    And the response should be a collection
#    And the response collection should count 2 items
