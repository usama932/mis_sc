<?php

namespace App\Providers;

use App\Core\KTBootstrap;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\FrmRepositoryInterface;
use App\Repositories\FrmRepository;
use App\Repositories\Interfaces\QbRepositoryInterface;
use App\Repositories\Interfaces\LearningLogRepositoryInterface;
use App\Repositories\Interfaces\DipRepositoryInterface;
use App\Repositories\Interfaces\ProjectRepositoryInterface;
use App\Repositories\Interfaces\DipActivityInterface;
use App\Repositories\QbRepository;
use App\Repositories\LearninglogRepository;
use App\Repositories\DipRepository;
use App\Repositories\DipActivityRepository;
use App\Repositories\ProjectRepository;


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
        $this->app->bind(LearningLogRepositoryInterface::class, LearninglogRepository::class);
        $this->app->bind(DipRepositoryInterface::class, DipRepository::class);
        $this->app->bind(DipActivityInterface::class, DipActivityRepository::class);
        $this->app->bind(ProjectRepositoryInterface::class, ProjectRepository::class);
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
