<?php
namespace Fish\OneValidator\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;


class PublishAssetsCommand extends Command {

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

        if (file_exists(app_path("controllers/OneValidatorController.php"))) {
            $this->error('The validator was already initalized');
            return false;
        }

        copy(__DIR__."/../assets/OneValidatorController.php",app_path("controllers/OneValidatorController.php"));
        copy(__DIR__."/../assets/one-validator.min.js",public_path("one-validator.min.js"));

        $routes = file_get_contents(__DIR__.'/../assets/routes.php');
        file_put_contents(app_path(). "/routes.php", PHP_EOL . $routes, FILE_APPEND);

        $this->info('Successfully initialized one-validator.');
        return true;

    }



}
