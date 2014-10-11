<?php
namespace Fish\OneValidator\Commands;

use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Foundation\Application as App;
use Fish\OneValidator\AssetsPublisher;

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
     * @var \Fish\OneValidator\AssetsPublisher
     */
    protected $publisher;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $version = $this->laravelVersion();
        $this->publisher = new AssetsPublisher($version);
    }

    /**
     * Execute the console command.
     */
    public function fire()
    {
        if (!$this->publisher->publish()):
            $this->error('The validator was already initalized');
            return false;
        endif;

           $this->info('Successfully initialized one-validator.');

        return true;

    }

}
