<?php

use Fish\OneValidator\PHP\FileFetcher\FileFetcher;
use Fish\OneValidator\PHP\Extractor\RulesExtractor;
class RulesExtractorTest extends OneValidatorTester
{
   /**
    * @var \FunctionalTester
    */
    protected $tester;

    protected $filePath;

    protected $fetcher;

    protected $extractor;

    public function __construct() {
        $this->path = "/../workbench/fish/one-validator/tests/_data/";

    }

    /** @test **/
    public function extract_the_rules_array() {

        $actual = $this->extract("ExampleValidator.php");

        $expected = $this->rules;

        $this->assertEquals($expected,$actual);

    }

    /** @test **/
    public function returns_false_when_rules_array_cannot_be_found() {

        $extracted = $this->extract("ExampleInvalidValidator.php");

        $this->assertFalse($extracted);

    }

    private function extract($file) {

        $fetcher = new FileFetcher(app_path($this->path . $file));

        $file = $fetcher->fetch();

        $extractor = new RulesExtractor($file);

        $rules = $extractor->extract();

        return $rules;

    }
}

