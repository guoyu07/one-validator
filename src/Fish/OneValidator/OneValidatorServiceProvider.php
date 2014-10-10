<?php namespace Fish\OneValidator;

use Illuminate\Support\ServiceProvider;

class OneValidatorServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

    public function boot() {
        // register package
        $this->package('fish/one-validator','validator');

        // bind artisan command to the IoC container
        $this->app->bind('fish::command.validator.convert', function() {
            return $this->app->make('Fish\OneValidator\Commands\ConvertRulesCommand');
        });

        // bind artisan command to the IoC container
        $this->app->bind('fish::command.validator.publish', function() {
            return $this->app->make('Fish\OneValidator\Commands\PublishAssetsCommand');
        });

        $this->commands(array(
            'fish::command.validator.convert',
            'fish::command.validator.publish'
        ));


    }

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
