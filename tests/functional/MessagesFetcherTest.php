<?php

use Fish\OneValidator\Convert\MessagesFetcher;

class MessagesFetcherTest extends \Codeception\TestCase\Test
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
    public function fetch_validation_messages()
    {
        $fetcher = new MessagesFetcher("en");

        $messages = $fetcher->fetch();

        $this->assertTrue(isset($messages['rangelength']));
    }

}