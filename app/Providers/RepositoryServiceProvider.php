<?php

namespace App\Providers;

use App\Modules\Cashback\Repositories\CashbackAble\CashbackActionRepository;
use App\Modules\Cashback\Repositories\CashbackAble\Interfaces\CashbackAbleRepositoryInterface;
use App\Modules\Cashback\Repositories\CashbackType\CashbackActionProcessByType;
use App\Modules\Cashback\Repositories\CashbackType\Interfaces\CashbackActionProcessInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CashbackAbleRepositoryInterface::class, CashbackActionRepository::class);
        $this->app->bind(CashbackActionProcessInterface::class, CashbackActionProcessByType::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
