<?php
$path = "/Users/matanya/Sites/one-validator";
$controller = $path . "/app/controllers/OneValidatorController.php";
$js = $path . "/public/one-validator.min.js";
$routes = $path . "/app/routes.php";
$routesContent = trim(preg_replace("/\/\/.?One validator.+/s","",file_get_contents($routes)));
file_put_contents($routes,$routesContent);

if (file_exists($controller)) unlink($controller);
if (file_exists($js)) unlink($js);

$I = new AcceptanceTester($scenario);

$I->am('a developer');
$I->wantTo('publish the package assets');

$I->runShellCommand("cd /Users/matanya/Sites/one-validator && php artisan validator:init");

$I->seeInShellOutput("Successfully initialized one-validator.");
$I->seeFileFound($controller);
$I->seeInThisFile("OneValidatorController");
$I->seeFileFound($js);
$I->seeInThisFile("OneValidator");
$I->seeFileFound($routes);
$I->seeInThisFile('One validator');

$I->runShellCommand("cd /Users/matanya/Sites/one-validator && php artisan validator:init");
$I->seeInShellOutput("The validator was already initalized");

unlink($controller);
$I->runShellCommand("cd /Users/matanya/Sites/one-validator && php artisan validator:convert /../workbench/fish/one-validator/tests/_data/ExampleValidator.php --target='file.js'");
$I->seeInShellOutput("The validator has not been initalized. Please run 'php artisan validator:init'");

$I->runShellCommand("cd /Users/matanya/Sites/one-validator && php artisan validator:init");