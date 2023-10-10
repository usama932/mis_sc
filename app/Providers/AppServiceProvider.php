<?php

namespace App\Providers;

use App\Core\KTBootstrap;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\FrmRepositoryInterface;
use App\Repositories\FrmRepository;
use App\Repositories\Interfaces\QbRepositoryInterface;
use App\Repositories\QbRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(FrmRepositoryInterface::class, FrmRepository::class);
        $this->app->bind(QbRepositoryInterface::class, QbRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Update defaultStringLength
        Builder::defaultStringLength(191);

        KTBootstrap::init();
    }
}
