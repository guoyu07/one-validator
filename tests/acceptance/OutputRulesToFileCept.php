<?php

$file = __DIR__ . '/../../../../../app/file.js';
if (file_exists($file)) unlink($file);

$I = new AcceptanceTester($scenario);
$I->wantTo('run the atrisan command and see the output in a file');

$I->runShellCommand("cd /Users/matanya/Sites/one-validator && php artisan validator:init");
$I->runShellCommand("cd /Users/matanya/Sites/one-validator && php artisan validator:convert /../workbench/fish/one-validator/tests/_data/ExampleValidator.php --target='file.js'");
$I->seeInShellOutput("The file was created at /Users/matanya/Sites/one-validator/app/file.js");
$I->seeFileFound($file);
$I->seeInThisFile("regex_field");


