<?php
namespace Fish\OneValidator\Commands;

use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Foundation\Application as App;

class PublishAssetsCommand extends MyCommand {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'validator:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish the package assets to the project.';


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function fire()
    {
        $version = $this->laravelVersion();

        $controllerPath = $version<5?"controllers/OneValidatorController.php":"Http/Controllers/OneValidatorController.php";
        $controller = app_path($controllerPath);
        $routesPath = $version<5?"routes.php":"Http/routes.php";
        $route = app_path($routesPath);

        if (file_exists($controller)) {
            $this->error('The validator was already initalized');
            return false;
        }

        copy(__DIR__."/../assets/OneValidatorController.php",$controller);
        copy(__DIR__."/../assets/one-validator.min.js",public_path("one-validator.min.js"));

        $routes = file_get_contents(__DIR__.'/../assets/routes.php');
        file_put_contents($route, PHP_EOL . $routes, FILE_APPEND);

        $this->info('Successfully initialized one-validator.');
        return true;

    }





}
