<?php
use Fish\OneValidator\Convert\RulesConverter;

    class RulesConvertorTest extends OneValidatorTester
{
   /**
    * @var \FunctionalTester
    */
    protected $tester;


    /** @test */
    public function convert_php_rules_to_javascript()
    {
        $converter = new RulesConverter($this->rules);
        $actual = $converter->convert();

        $serialized = file_get_contents(__DIR__ . "/../_data/expected.serialized");
        $excpeted = unserialize($serialized);

        $this->assertEquals($excpeted, $actual);
    }

}