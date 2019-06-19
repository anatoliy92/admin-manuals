<?php

namespace Avl\AdminManuals;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Config;

class AdminManualsServiceProvider extends AuthServiceProvider
{

	/**
   * The policy mappings for the application.
   *
   * @var array
   */
  protected $policies = [
    \Avl\AdminManuals\Models\Manuals::class => \Avl\AdminManuals\Policies\ManualsPolicy::class,
  ];

		/**
		 * Bootstrap the application services.
		 *
		 * @return void
		 */
		public function boot()
		{
			$this->registerPolicies();
			// dd('manuals');
				// Публикуем файл конфигурации
				// $this->publishes([
				// 		__DIR__ . '/../config/adminmanuals.php' => config_path('adminmanuals.php'),
				// ]);

				$this->publishes([
						__DIR__ . '/../public' => public_path('vendor/adminmanuals'),
				], 'public');

				$this->loadRoutesFrom(__DIR__ . '/routes.php');

				$this->loadViewsFrom(__DIR__ . '/../resources/views', 'adminmanuals');
		}

		/**
		 * Register the application services.
		 *
		 * @return void
		 */
		public function register()
		{
				// объединение настроек с опубликованной версией
				$this->mergeConfigFrom(__DIR__ . '/../config/adminmanuals.php', 'adminmanuals');

				// migrations
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

		}

}
