<?php

namespace App\Providers;

use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider {
	
	/**
	 * Register bindings in the container.
	 *
	 * @return void
	 */
	public function boot(ViewFactory $view)
	{
		//Set variable global and put some variables to javascript
		$view->composer('*', 'App\Http\ViewComposers\GlobalComposer');
		
	}
	
	public function register()
	{
		//
	}
	
}