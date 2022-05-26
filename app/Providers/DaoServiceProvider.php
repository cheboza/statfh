<?php

namespace App\Providers;

use App\Helpers\SearchWords;
use App\Http\Dao\GoodsDao;
use App\Http\Dao\SearchDao;
use App\Http\Dao\StatisticsDao;
use Illuminate\Support\ServiceProvider;

class DaoServiceProvider extends ServiceProvider
{

    /**
     * Все синглтоны контейнера, которые должны быть зарегистрированы.
     *
     * @var array
     */
    public $singletons = [
        SearchDao::class => SearchDao::class,
        GoodsDao::class => GoodsDao::class,
        StatisticsDao::class => StatisticsDao::class
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('searchWord', SearchWords::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {}
}
