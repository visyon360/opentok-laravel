<?php namespace Tomcorbett\OpentokLaravel;

use Illuminate\Support\ServiceProvider;
use OpenTok\OpenTok;
use \Config;

class OpentokLaravelServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
	    $config = realpath(__DIR__.'/../../config/config.php');
	     
	    $this->mergeConfigFrom($config, 'opentok.laravel');
	     
	    $this->publishes([
	        $config => config_path('opentok-laravel.php')
	    ], 'config');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{   	
        $this->app->bind('OpentokApi', function() {
            
            $api_key    = config('opentok-laravel.api_key');
            $api_secret = config('opentok-laravel.api_secret');
                    
            // create new instance of SDK
            $openTokApi = new OpenTok($api_key, $api_secret);

            // return pusher
            return $openTokApi;
        });
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
