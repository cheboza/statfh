<?php

namespace App\Providers;

use App\Http\Dao\GoodsDao;
use App\Http\Dao\SearchDao;
use App\Http\Dao\StatisticsDao;
use App\Http\Service\GoodsService;
use App\Http\Service\Search\SearchService;
use App\Http\Service\Search\SearchWordHandler;
use App\Http\Service\StatisticsService;
use Illuminate\Support\ServiceProvider;

class MainServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SearchService::class, function ($app) {
            return new SearchService($app->make(SearchWordHandler::class), $app->make(SearchDao::class));
        });
        $this->app->bind(GoodsService::class, function ($app) {
            return new GoodsService($app->make(GoodsDao::class));
        });
        $this->app->bind(StatisticsService::class, function ($app) {
            return new StatisticsService($app->make(StatisticsDao::class));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {}
}
