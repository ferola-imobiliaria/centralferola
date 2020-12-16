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
        //Se a aplicação estiver setada como ambiente de produção, será utilizado https na url
        if (config('app.env') === 'production') {
            \URL::forceScheme('https');
            $this->app['request']->server->set('HTTPS', 'on');
        }

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

        $this->app->bind(
            'App\Repositories\PointsTableRepositoryInterface',
            'App\Repositories\PointsTableRepository'
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
