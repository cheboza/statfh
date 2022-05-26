<?php

namespace App\Http\Service;

use App\Http\Dao\StatisticsDao;
use App\Http\Response\StatisticsChartsResponse;
use App\Http\Service\Statistics\DateFormatStatistics;

class StatisticsService
{
    private $statisticsDao;

    /**
     * @param StatisticsDao $statisticsDao
     */
    public function __construct(StatisticsDao $statisticsDao)
    {
        $this->statisticsDao = $statisticsDao;
    }

    /**
     * Статистика по магазинам
     * */
    public function getShopStatistic(int $countMonth): StatisticsChartsResponse
    {
        $dateFormat = new DateFormatStatistics($countMonth);

        $stat = $this->statisticsDao->getStatisticsByOrders($dateFormat->getDateStart(), $dateFormat->getDateFinish());

        list($salePoints_response, $stat_response)
            = $this->getAxisData($stat, $dateFormat, array($this->statisticsDao, "getSalePointsById"));

        // overall statistic by shops
        $stat_all = $this->statisticsDao->getStatisticsForAllOrders($dateFormat->getDateStart(), $dateFormat->getDateFinish());

        $stat_all_response = array_fill_keys($dateFormat->getSqlFormatRang(), 0);
        $stat_all->each(function ($item, $key) use (&$stat_all_response) {
            $stat_all_response[$item->date_created] = $item->summ;
        });

        $stat_response[] = array_values($stat_all_response);
        $salePoints_response[] = ['title' => 'Все'];

        return new StatisticsChartsResponse($dateFormat->getRangResponse(), $salePoints_response, $stat_response);
    }

    /**
     * Статистика по товарам
     * */
    public function getGoodsStatistic(int $countMonth, string $unit, array $salePoints, array $ids_goods):StatisticsChartsResponse
    {
        $dateFormat = new DateFormatStatistics($countMonth);

        $stat = $this->statisticsDao->getStatisticsByGoods($dateFormat->getDateStart(), $dateFormat->getDateFinish(), $unit, $salePoints, $ids_goods);

        list($goods_name, $stat_response)
            = $this->getAxisData($stat, $dateFormat, array($this->statisticsDao, "getGoodsByIdForStat"));

        return new StatisticsChartsResponse($dateFormat->getRangResponse(), $goods_name, $stat_response);
    }

    public function getCollectionsStatistic(int $countMonth, string $unit, array $salePoints, array $ids_collections):StatisticsChartsResponse
    {
        $dateFormat = new DateFormatStatistics($countMonth);

        $stat = $this->statisticsDao->getStatisticsByCollections($dateFormat->getDateStart(), $dateFormat->getDateFinish(), $unit, $salePoints, $ids_collections);

        list($goods_name, $stat_response)
            = $this->getAxisData($stat, $dateFormat, array($this->statisticsDao, "getGoodsByIdForStat"));

        return new StatisticsChartsResponse($dateFormat->getRangResponse(), $goods_name, $stat_response);
    }

    public function getSellersStatistic($countMonth, $unit, $salePoints):StatisticsChartsResponse
    {
        $dateFormat = new DateFormatStatistics($countMonth);

        $stat = $this->statisticsDao->getStatisticsBySellers($dateFormat->getDateStart(), $dateFormat->getDateFinish(), $unit, $salePoints);

        list($goods_name, $stat_response)
            = $this->getAxisData($stat, $dateFormat, array($this->statisticsDao, "getSellersByIdForStat"));

        return new StatisticsChartsResponse($dateFormat->getRangResponse(), $goods_name, $stat_response);
    }

    public function getBrandsStatistic($countMonth, $unit, $salePoints, $brands):StatisticsChartsResponse
    {
        $dateFormat = new DateFormatStatistics($countMonth);

        $stat = $this->statisticsDao->getStatisticsByBrands($dateFormat->getDateStart(), $dateFormat->getDateFinish(), $unit, $salePoints, $brands);

        list($goods_name, $stat_response)
            = $this->getAxisData($stat, $dateFormat, array($this->statisticsDao, "getBrandsByIdForStat"));

        return new StatisticsChartsResponse($dateFormat->getRangResponse(), $goods_name, $stat_response);
    }

    public function getCategoriesStatistic($countMonth, $unit, $salePoints, $categories):StatisticsChartsResponse
    {
        $dateFormat = new DateFormatStatistics($countMonth);

        $stat = $this->statisticsDao->getStatisticsByCategory($dateFormat->getDateStart(), $dateFormat->getDateFinish(), $unit, $salePoints, $categories);

        list($goods_name, $stat_response)
            = $this->getAxisData($stat, $dateFormat, array($this->statisticsDao, "getCategoriesByIdForStat"));

        return new StatisticsChartsResponse($dateFormat->getRangResponse(), $goods_name, $stat_response);
    }

    /**
     * Получаем данные для осей графика
     * */
    private function getAxisData($stat, $dateFormat, callable $responseDao): array
    {
        $axisY_ids = $stat->pluck('axisy_id')->unique()->values();
        $axisY_response = call_user_func($responseDao, $axisY_ids);

        $stat_scheme = array_fill_keys($axisY_ids->toArray(), array_fill_keys($dateFormat->getSqlFormatRang(), 0));

        $stat->each(function ($item, $key) use (&$stat_scheme) {
            $stat_scheme[$item->axisy_id][$item->date_created] = $item->summ;
        });

        $axisX_response = [];
        foreach ($stat_scheme as $scheme) {
            $axisX_response[] = array_values($scheme);
        }

        return array($axisY_response, $axisX_response);
    }


}
