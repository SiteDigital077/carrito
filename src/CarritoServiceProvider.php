<?php

namespace DigitalsiteSaaS\Carrito;

use Illuminate\Support\ServiceProvider;

/**
* 
*/
class CarritoServiceProvider extends ServiceProvider
{
	
	 public function register()
	{
		$this->app->bind('carrito', function($app) {
			return new Carrito;

		});
	}

	public function boot()
	{
		
		require __DIR__ . '/Http/routes.php';

		$this->loadViewsFrom(__DIR__ . '/../views', 'carrito');

	}

}

