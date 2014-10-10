<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;
//
// Require 3rd-party libraries here:
//
//   require_once 'PHPUnit/Autoload.php';
//   require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
 * Features context.
 */
class FeatureContext extends MinkContext
{

    protected $messages;
    protected $dependentMessages;
    /**
     * Initializes context.
     * Every scenario gets its own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        $this->messages = [
         //   "The accepted field must be accepted.",
            "The Active URL is not a valid URL.",
            "The alpha field may only contain letters.",
            "The alpha dash field may only contain letters, numbers, and dashes.",
            "The alpha num field may only contain letters and numbers.",
            "The array field must be an array.",
            "The alpha num field may only contain letters and numbers.",
            "The array field must be an array.",
            "The between numeric field must be between 5 and 10.",
            "The between string field must be between 10 and 20 characters.",
            "The array field must be an array.",
            "The boolean field field must be true or false",
            "The confirmed field confirmation does not match.",
            "The different field and alpha field must be different.",
            "The digits field must be 8 digits.",
            "The digits between field must be between 4 and 6 digits.",
            "The Email Address must be a valid email address.",
            "The selected exists field is invalid.",
            "The selected in field is must be in some", // TODO: replace coma with coma and space
            "The integer field must be an integer.",
            "The ip field must be a valid IP address.",
            "The max numeric field may not be greater than 10.",
            "The max string field may not be greater than 14 characters.",
            "The min numeric field must be at least 10.",
            "The min string field must be at least 14 characters.",
            "The numeric field must be a number.",
            "The regex field format is invalid.",
            "The required field field is required",
            "The same field and digits field must match.",
            "The size numeric field must be 10",
            "The size string field must be 5 characters",
            "The unique field has already been taken.",
            "The url field format is invalid."

        ];

        $this->dependentMessages = [
            "The required if field field is required when Email Address is matfish2@gmail.com.",
            "The required with field field is required when ip field / digits field is present",
            "The required with all field field is required when",
            "The required without field field is required when integer field / numeric field is not present.",
            "The required without all field field is required when none of Active URL / min string field are present."
        ];

    }


    /**
     * @Given /^I fill in the form incorrectly$/
     */
    public function iFillInTheFormIncorrectly()
    {

        $data = [
        ["field"=>"active_url_field","value"=>"http://non-existant-url.net"],
        ["field"=>"alpha_field","value"=>"p4"],
        ["field"=>"alpha_dash_field","value"=>"p+=-4"],
        ["field"=>"alpha_num_field","value"=>"p4?"],
        ["field"=>"array_field","value"=>"not_an_array"],
        ["field"=>"between_numeric_field","value"=>3],
        ["field"=>"between_string_field","value"=>"too_short"],
        ["field"=>"boolean_field","value"=>"not_bool"],
        ["field"=>"confirmed_field","value"=>"secret"],
        ["field"=>"confirmed_field_confirmation","value"=>"secretly"],
        ["field"=>"different_field","value"=>"p4"],
        ["field"=>"digits_field","value"=>"12345"],
        ["field"=>"digits_between_field","value"=>"33"],
        ["field"=>"email_field","value"=>"invalid@email"],
        ["field"=>"exists_field","value"=>"exists@dov.com"],
        ["field"=>"in_field","value"=>"not_in_array"],
        ["field"=>"integer_field","value"=>100.33],
        ["field"=>"ip_field","value"=>"256.255.255.255"],
        ["field"=>"max_numeric_field","value"=>2000],
        ["field"=>"max_string_field","value"=>"more than 14 characters"],
        ["field"=>"min_numeric_field","value"=>3],
        ["field"=>"min_string_field","value"=>"lest than 14c"],
        ["field"=>"numeric_field","value"=>"NaN"],
        ["field"=>"regex_field","value"=>"noMatch"],
        ["field"=>"required_field","value"=>""],
        ["field"=>"same_field","value"=>"1234"],
        ["field"=>"size_numeric_field","value"=>"9"],
        ["field"=>"size_string_field","value"=>"abcd"],
        ["field"=>"unique_field","value"=>"matfish2@gmail.com"],
        ["field"=>"url_field","value"=>"httpnotAurl"],

            ];

        foreach ($data as $field) {
            $this->fillField($field['field'],$field['value']);
        }


    }

    /**
     * @Then /^I should see (.+) validation errors$/
     */
    public function iShouldSeeValidationErrors($type)
    {

        foreach ($this->messages as $message):
            $this->assertPageContainsText($message);
        endforeach;
      

    }

    /**
     * @Given /^I wait for the remote validation errors$/
     */
    public function iWaitForTheRemoteValidationErrors()
    {
        $this->getSession()->wait(200);
    }

    /**
     * @Given /^I fill in the form dependent fields incorrectly$/
     */
    public function iFillInTheFormDependentFieldsIncorrectly()
    {
        $data = [["field"=>"email_field","value"=>"matfish2@gmail.com"],
        ["field"=>"ip_field","value"=>"127.0.0.1"],
        ["field"=>"max_string_field","value"=>"abcde"],
        ["field"=>"numeric_field","value"=>2.44]];

        foreach ($data as $field) {
           $this->fillField($field['field'],$field['value']);
        }
    }


    /**
     * @Then /^I should see (.+) dependent fields errors$/
     */
    public function iShouldSeeDependentFieldsErrors()
    {
        foreach ($this->dependentMessages as $message):
            $this->assertPageContainsText($message);
        endforeach;
    }






    /**
     * @Given /^I fill in the form correctly$/
     */
    public function iFillInTheFormCorrectly()
    {
        $data = [
            ["field"=>"active_url_field","value"=>"http://www.nrg.co.il"],
            ["field"=>"alpha_field","value"=>"lettersonly"],
            ["field"=>"alpha_dash_field","value"=>"letters-and-dashes"],
            ["field"=>"alpha_num_field","value"=>"stringand10"],
            ["field"=>"array_field","value"=>""],
            ["field"=>"between_numeric_field","value"=>6],
            ["field"=>"between_string_field","value"=>"just enough"],
            ["field"=>"boolean_field","value"=>"1"],
            ["field"=>"confirmed_field","value"=>"secret"],
            ["field"=>"confirmed_field_confirmation","value"=>"secret"],
            ["field"=>"different_field","value"=>"letters"],
            ["field"=>"digits_field","value"=>"12345678"],
            ["field"=>"digits_between_field","value"=>"12345"],
            ["field"=>"email_field","value"=>"matfish2@gmail.com"],
            ["field"=>"exists_field","value"=>"matfish2@gmail.com"],
            ["field"=>"in_field","value"=>"some"],
            ["field"=>"integer_field","value"=>100],
            ["field"=>"ip_field","value"=>"255.255.255.255"],
            ["field"=>"max_numeric_field","value"=>10],
            ["field"=>"max_string_field","value"=>"lesschars"],
            ["field"=>"min_numeric_field","value"=>15],
            ["field"=>"min_string_field","value"=>"more than fifteen letters"],
            ["field"=>"numeric_field","value"=>4.55],
            ["field"=>"regex_field","value"=>"abcd"],
            ["field"=>"required_field","value"=>"required"],
            ["field"=>"same_field","value"=>"12345678"],
            ["field"=>"size_numeric_field","value"=>"10"],
            ["field"=>"size_string_field","value"=>"abcde"],
            ["field"=>"unique_field","value"=>"matfish3@gmail.com"],
            ["field"=>"url_field","value"=>"http://www.nrg.com"]

        ];

        foreach ($data as $field) {
            $this->fillField($field['field'],$field['value']);
        }
    }

    /**
     * @Then /^I should NOT see (.+) validation errors$/
     */
    public function iShouldNotSeeValidationErrors()
    {
        foreach ($this->messages as $message):
            $this->assertPageNotContainsText($message);
        endforeach;
    }



    /**
     * @Given /^I fill in the dependent fields correctly$/
     */
    public function iFillInTheDependentFieldsCorrectly()
    {
        $data = [["field"=>"email_field","value"=>"matfish2@gmail.com"],
            ["field"=>"ip_field","value"=>"127.0.0.1"],
            ["field"=>"max_string_field","value"=>"abcde"],
            ["field"=>"numeric_field","value"=>2.44],
            ["field"=>"required_if_field","value"=>"not empty"],
            ["field"=>"required_with_field","value"=>"not empty"],
            ["field"=>"required_without_field","value"=>"not empty"],
            ["field"=>"required_with_all_field","value"=>"not empty"],
            ["field"=>"required_without_all_field","value"=>"not empty"]
        ];

        foreach ($data as $field) {
            $this->fillField($field['field'],$field['value']);
        }
    }

    /**
     * @Then /^I should NOT see (.+) dependent fields errors$/
     */
    public function iShouldNotSeeDependentFieldsErrors()
    {
        foreach ($this->dependentMessages as $message):
            $this->assertPageNotContainsText($message);
        endforeach;
    }



}
