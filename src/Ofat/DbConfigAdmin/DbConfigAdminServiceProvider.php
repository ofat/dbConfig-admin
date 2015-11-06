<?php namespace Ofat\DbConfigAdmin;

use Illuminate\Support\ServiceProvider;
use Nayjest\Common\ViewsIntegration;

class DbConfigAdminServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('ofat/dbConfigAdmin');

		//ViewsIntegration::apply('dbConfigAdmin');

		include __DIR__ . '/../../routes.php';
	}

	public function register()
	{

	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [
			'Terbium\DbConfig\DbConfigServiceProvider'
		];
	}

}
