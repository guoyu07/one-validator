<?php

use Fish\OneValidator\JS\TemplateRenderer;

class TemplateRendererTest extends \Codeception\TestCase\Test
{
   /**
    * @var \FunctionalTester
    */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    /** @test */
    public function render_rules_into_the_template()
    {

        $rules = ['url'=>['url'=>true]];
        $renderer = new TemplateRenderer();
        $rendered = $renderer->render($rules);

        $stub = file_get_contents(__DIR__ . '/../_data/rules.stub');

        $this->assertEquals($stub, $rendered);

    }

}