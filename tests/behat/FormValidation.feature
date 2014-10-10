Feature: Form validation
  In order to validate the form on the client-side
  and have it mirror the server-side validation
  as a developer
  I want to run an artisan command that will generate the javascript code
  and add all the necessary assets. Then I expect the client-side validation
  to be an (almost) exact replica of the server-side

  @javascript
  Scenario: Client side  - INVALID
    Given I am on "/public"
    And I fill in the form incorrectly
    And I press "Submit"
    And I wait for the remote validation errors
    Then I should see JQuery's validation errors

  Scenario: Server side - INVALID
    Given I am on "/public"
    And I fill in the form incorrectly
    And I press "Submit"
    Then I should see Laravel's validation errors

  @javascript
  Scenario: Client side - INVALID DEP. RULES
    Given I am on "/public"
    And I fill in the form dependent fields incorrectly
    And I press "Submit"
    Then I should see JQuery's dependent fields errors

  Scenario: Server side  - INVALID DEP. RULES
    Given I am on "/public"
    And I fill in the form dependent fields incorrectly
    And I press "Submit"
    Then I should see Laravel's dependent fields errors

  @javascript
  Scenario: Client side  - CORRECT
    Given I am on "/public"
    And I fill in the form correctly
    And I press "Submit"
    Then  I should NOT see JQuery's validation errors

  Scenario: Server side  - CORRECT
    Given I am on "/public"
    And I fill in the form correctly
    And I press "Submit"
    Then  I should NOT see Laravel's validation errors

  @javascript
  Scenario: Client side  - CORRECT DEP. FIELDS
    Given I am on "/public"
    And I fill in the dependent fields correctly
    And I press "Submit"
    Then  I should NOT see "JQuery's" dependent fields errors

  Scenario: Server side - CORRECT DEP. FIELDS
    Given I am on "/public"
    And I fill in the dependent fields correctly
    And I press "Submit"
    Then  I should NOT see "Laravel's" dependent fields errors