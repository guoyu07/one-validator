<?php

use Fish\OneValidator\PHP\FileFetcher\FileFetcher;

class FileFetcherTest extends \Codeception\TestCase\Test
{
   /**
    * @var \FunctionalTester
    */
    protected $tester;

    /**
     * @var
     */
    protected $path;

    public function __construct() {
        $this->path = "/../workbench/fish/one-validator/tests/_data/";

    }


    /** @test */
    public function fetch_a_file()
    {
        $fetcher = new FileFetcher(app_path($this->path . 'ExampleValidator.php'));
        $fetcher->fetch();

    }


    /** @test
     * @expectedException Fish\OneValidator\PHP\FileFetcher\Exceptions\InvalidFileFormatException
     **/
    public function throw_an_exception_when_file_has_no_php_extension() {
        $fetcher = new FileFetcher(app_path($this->path . 'wrong.txt'));
        $fetcher->fetch();
    }

    /** @test
     * @expectedException Fish\OneValidator\PHP\FileFetcher\Exceptions\InvalidFileFormatException
     **/
    public function throw_an_exception_when_file_has_no_php_opening_tag() {
        $fetcher = new FileFetcher(app_path($this->path . 'testnotphp.php'));
        $fetcher->fetch();
    }


}