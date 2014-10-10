<?php

use Fish\OneValidator\JS\OutputHandler;

class OutputHandlerTest extends \Codeception\TestCase\Test
{
   /**
    * @var \FunctionalTester
    */
    protected $tester;


    /** @test */
    public function output_to_console_or_to_file_based_on_the_traget_option() {
        $file = app_path('output.js');
        $handler = new OutputHandler("output of js rules",false);
        $this->assertEquals("output of js rules", $handler->get());

        $handler = new OutputHandler("output of js rules",$file);
        $output = $handler->get();

        $this->assertTrue(file_exists($file));

        $expected = "The file was created at " . $file;
        $this->assertEquals($expected,$output);

        unlink($file);
    }


}