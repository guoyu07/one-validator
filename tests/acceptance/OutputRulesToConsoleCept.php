<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('run the atrisan command and see the output in the console');

$I->runShellCommand("cd /Users/matanya/Sites/one-validator && php artisan validator:init");
$I->runShellCommand("cd /Users/matanya/Sites/one-validator && php artisan validator:convert /../workbench/fish/one-validator/tests/_data/ExampleValidator.php");

$output = file_get_contents(__DIR__ ."/../_data/output.js");

$I->seeInShellOutput("regex_field");
