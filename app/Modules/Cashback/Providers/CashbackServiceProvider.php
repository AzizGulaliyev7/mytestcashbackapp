<?php

namespace App\Modules\Cashback\Providers;

use App\Modules\Cashback\Repositories\CashbackAble\CashbackActionRepository;
use App\Modules\Cashback\Repositories\CashbackAble\Interfaces\CashbackAbleRepositoryInterface;
use App\Modules\Cashback\Repositories\CashbackType\CashbackActionProcessByType;
use App\Modules\Cashback\Repositories\CashbackType\Interfaces\CashbackActionProcessInterface;
use Illuminate\Support\ServiceProvider;
use Route;

class CashbackServiceProvider  extends ServiceProvider
{
    protected $namespace = 'App\Modules\Cashback\Controllers';
    protected $apiPrefix = '/api/v1/';

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;


    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerConfig();
        $this->routes();
        if ($this->app->runningInConsole()) {
            $this->registerMigrations();
        }

        $this->app->bind(CashbackAbleRepositoryInterface::class, CashbackActionRepository::class);
        $this->app->bind(CashbackActionProcessInterface::class, CashbackActionProcessByType::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/config.php', 'cashback'
        );
    }


    /**
     * Register Installment's migration files.
     *
     * @return void
     */
    protected function registerMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    public function routes()
    {
        Route::
        prefix($this->apiPrefix)
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../routes/route.php');
    }
}
