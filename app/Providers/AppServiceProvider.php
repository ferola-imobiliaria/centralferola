<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Utilizando o Faker em português
        $this->app->singleton(\Faker\Generator::class, function () {
            return \Faker\Factory::create('pt_BR');
        });

        $this->app->bind(
            'App\Repositories\CommissionRepositoryInterface',
            'App\Repositories\CommissionRepository'
        );

        $this->app->bind(
            'App\Repositories\ProductionRepositoryInterface',
            'App\Repositories\ProductionRepository'
        );

        $this->app->bind(
            'App\Repositories\TeamRepositoryInterface',
            'App\Repositories\TeamRepository'
        );

        $this->app->bind(
            'App\Repositories\UserRepositoryInterface',
            'App\Repositories\UserRepository'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Route::resourceVerbs([
            'create' => 'criar',
            'edit' => 'editar'
        ]);
    }
}
