<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => ['auth']], function () {

    // First access - Change Password
    Route::name('password.change.')->prefix('primeiro-acesso')->group(function () {
        Route::get('/trocar-senha', 'Auth\ChangePasswordController@index')
            ->name('first.access.index');
        Route::post('/trocar-senha', 'Auth\ChangePasswordController@changePassword')
            ->name('first.access');
    });

    Route::group(['middleware' => ['password.change']], function () {

        Route::get('/', 'HomeController@index')->name('home');

        // Users
        Route::name('user.')->prefix('usuarios')->group(function () {
            Route::middleware('can:is-admin-or-supervisor')->group(function () {
                Route::get('/', 'UserController@index')->name('index');
                Route::delete('/user/{user}', 'UserController@destroy')->name('destroy');
                Route::get('/lixeira', 'UserController@trashed')->name('trashed');
                Route::get('{user}/restore', 'UserController@restore')->name('restore');
                Route::delete('/{user}/destroyPermanently', 'UserController@destroyPermanently')
                    ->name('destroyPermanently');
            });
            Route::get('{user}/editar', 'UserController@edit')->name('edit');
            Route::put('{user}', 'UserController@update')->name('update');
            Route::get('/trocar-senha', 'UserController@changePasswordForm')->name('change.password.form');
            Route::put('{user}/trocar-senha', 'UserController@changePassword')->name('change.password');
        });

        // Teams
        Route::resource('equipes', 'TeamController')->names('team')->middleware('can:is-admin');

        // Placings
        Route::get('classificacoes', 'PlacingController@index')->name('placings.index')->middleware('can:is-admin');;

        // Productions
        Route::name('production.')->prefix('producao')->group(function () {
            Route::get('/', 'ProductionController@index')->name('index');
            Route::post('consultar', 'ProductionController@consult')->name('consult');
            Route::post('cadastrar', 'ProductionController@store')->name('store');
        });

        // Commissions Control
        Route::resource('controle-comissao', 'CommissionsControlController')->names('commissions-control');

        // Informatives
        Route::get('informativos/despublicados', 'InformativeController@unpublished')->name('informative.unpublished');
        Route::resource('informartivo', 'InformativeController', [
            'parameters' => [
                'informartivo' => 'informative'
            ]
        ])->names('informative');

        // Points Table
        Route::name('points-table.')->prefix('tabela-pontos')->group(function () {
            Route::get('/', 'PointsTableController@index')->name('index');
            Route::post('/', 'PointsTableController@show')->name('show');
            Route::post('/cadastrar/pontos-e-metas', 'PointsTableController@storePointsTargets')->name('store.points.targets');
            Route::post('/cadastrar/infos', 'PointsTableController@storeInfos')->name('store.infos');
        });

        // Reports
        Route::name('report.')->prefix('relatorios')->group(function () {
            Route::get('/producao', 'ReportController@indexProduction')->name('production.índex');
            Route::post('/producao', 'ReportController@showProduction')->name('production.show');
            Route::get('/tabela-pontos', 'ReportController@indexPointsTable')->name('points-table.index');
            Route::post('/tabela-pontos', 'ReportController@showPointsTable')->name('points-table.show');
            Route::get('/controle-comissoes', 'ReportController@indexComissionsControl')->name('commissions-control.index');
        });

        // Receipts
        Route::name('receipt.')->prefix('recibos')->group(function () {
            Route::get('/', 'ReceiptController@index')->name('index');
            Route::post('/', 'ReceiptController@show')->name('show');
            Route::get('/{type}/{uuid}', 'ReceiptController@generate')->name('generate');
        });

        // Charts
        Route::name('chart.')->prefix('graficos')->group(function () {
            Route::get('/corretor', 'ChartRealtorController@index')->name('realtor');
            Route::get('/supervisor/{type}', 'ChartSupervisorController@index')->name('supervisor.index');
            Route::post('/supervisor/{type}', 'ChartSupervisorController@show')->name('supervisor.show');
        });

        //Financial
        Route::name('financial.')->prefix('financeiro')->group(function () {
            Route::get('/', 'FinancialController@index')->name('index');
        });

    });
});

Auth::routes();
