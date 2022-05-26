<?php

namespace App\Http\Dao;

use App\Model\Brand;
use App\Model\Category;
use App\Model\Goods;
use App\Model\Order;
use App\Model\ShopSalePoint;
use Illuminate\Support\Facades\DB;
use function foo\func;

class StatisticsDao
{
    /**
     * Получить статистику по каждой точке
     * */
    public function getStatisticsByOrders($date_start, $date_finish)
    {
        return Order::groupBy('sale_point_id', 'date_created')
                ->selectRaw('sale_point_id AS axisy_id, SUM(summ) AS summ, DATE_FORMAT(FROM_UNIXTIME(created),\'%Y/%m\') AS date_created')
                ->whereBetween('created', [$date_start->timestamp, $date_finish->timestamp])
                ->whereNotIn('status', ['2']) // if order no canceled
                ->orderBy('sale_point_id')
                ->get();
    }

    /**
     * Получить суммированую статистику по всем точкам
     * */
    public function getStatisticsForAllOrders($date_start, $date_finish)
    {
        return Order::groupBy('date_created')
                ->selectRaw('SUM(summ) AS summ, DATE_FORMAT(FROM_UNIXTIME(created),\'%Y/%m\') as date_created')
                ->whereBetween('created', [$date_start->timestamp, $date_finish->timestamp])
                ->whereNotIn('status', ['2']) // if order no canceled
                ->get();
    }

    /**
     * Получить статистику по товарам
     */
    public function getStatisticsByGoods($date_start, $date_finish, $unit, $salePoints, $ids_goods)
    {
        $unit_condition = $unit === 'count' ? 'SUM(diafan_og.count_goods)': 'SUM(diafan_og.count_goods * price)';

        return DB::connection(env('DB_FH_CONNECTION'))->table('shop_order AS o')
                    ->select(
                        'og.good_id AS axisy_id',
                        DB::raw('DATE_FORMAT(FROM_UNIXTIME(diafan_o.created),\'%Y/%m\') as date_created'),
                        DB::raw($unit_condition.' AS summ')
                    )
                    ->join('shop_order_goods AS og','o.id', '=', 'og.order_id')
                    ->groupBy('og.good_id', 'date_created')
                    ->where('o.trash', '0')->whereNotIn('o.status', ['2'])
                    ->whereBetween('o.created', [$date_start->timestamp, $date_finish->timestamp])
                    ->whereIn('o.sale_point_id', $salePoints)
                    ->whereIn('og.good_id', $ids_goods)
                    ->orderBy('og.good_id')
                    ->get();
    }

    public function getStatisticsByCollections($date_start, $date_finish, $unit, $salePoints, $ids_collections)
    {
        $unit_condition = $unit === 'count' ? 'SUM(diafan_og.count_goods)': 'SUM(diafan_og.count_goods * diafan_og.price)';

        return DB::connection(env('DB_FH_CONNECTION'))->table('shop_order AS o')
            ->select(
                'og.good_id AS axisy_id',
                DB::raw('DATE_FORMAT(FROM_UNIXTIME(diafan_o.created),\'%Y/%m\') as date_created'),
                DB::raw($unit_condition.' AS summ')
            )
            ->join(
                DB::raw('(SELECT c.composite_id, c.parent_id as good_id, ogin.count_goods, ogin.price, ogin.order_id FROM diafan_shop_composite c'
                            .' INNER JOIN diafan_shop_order_goods as ogin ON c.composite_id=ogin.good_id WHERE c.parent_id IN ('.
                    implode(',', array_map(function ($item){ return intval($item); }, $ids_collections)).')) diafan_og'), function($join) {
                $join->on('o.id', '=', 'og.order_id');
            })
            ->groupBy('og.good_id', 'date_created')
            ->where('o.trash', '0')->whereNotIn('o.status', ['2'])
            ->whereBetween('o.created', [$date_start->timestamp, $date_finish->timestamp])
            ->whereIn('o.sale_point_id', $salePoints)
            ->orderBy('og.good_id')
            ->get();
    }

    public function getStatisticsBySellers($date_start, $date_finish, $unit, $salePoints)
    {
        $unit_condition = $unit === 'count' ? 'COUNT(diafan_o.id)': 'SUM(diafan_o.summ)';

        return DB::connection(env('DB_FH_CONNECTION'))->table('shop_order AS o')
            ->select(
                'o.user_id AS axisy_id',
                DB::raw('DATE_FORMAT(FROM_UNIXTIME(diafan_o.created),\'%Y/%m\') as date_created'),
                DB::raw($unit_condition.' AS summ')
            )
            ->join(
                DB::raw('(SELECT surin.user_id FROM diafan_shop_spoint_user_rel surin '.
                    ' INNER JOIN diafan_users u ON u.id=surin.user_id '.
                    ' WHERE surin.sale_point_id IN ('.implode(',', array_map(function ($item){ return intval($item); }, $salePoints)).')) as diafan_sur'), function($join){
                $join->on('sur.user_id', '=', 'o.user_id');
            })
            ->groupBy('o.user_id', 'date_created')
            ->where('o.trash', '0')->whereNotIn('o.status', ['2'])
            ->whereBetween('o.created', [$date_start->timestamp, $date_finish->timestamp])
            ->whereIn('o.sale_point_id', $salePoints)
            ->orderBy('o.user_id')
            ->get();
    }

    public function getStatisticsByBrands($date_start, $date_finish, $unit, $salePoints, $brands)
    {
        $unit_condition = $unit === 'count' ? 'SUM(diafan_og.count_goods)': 'SUM(diafan_og.count_goods * diafan_og.price)';

        return DB::connection(env('DB_FH_CONNECTION'))->table('shop_order AS o')
            ->select(
                'og.brand_id AS axisy_id',
                DB::raw('DATE_FORMAT(FROM_UNIXTIME(diafan_o.created),\'%Y/%m\') as date_created'),
                DB::raw($unit_condition.' AS summ')
            )
            ->join(
                DB::raw('(SELECT ogin.good_id, ogin.count_goods, ogin.price, s.brand_id, ogin.order_id FROM diafan_shop_order_goods ogin'.
                    ' INNER JOIN diafan_shop s ON s.id=ogin.good_id AND s.brand_id IN'.
                    ' ('.implode(',', array_map(function ($item){ return intval($item); }, $brands)).')) as diafan_og'), function($join){
                            $join->on('og.order_id', '=', 'o.id');
                        })
            ->groupBy('og.brand_id', 'date_created')
            ->where('o.trash', '0')->whereNotIn('o.status', ['2'])
            ->whereBetween('o.created', [$date_start->timestamp, $date_finish->timestamp])
            ->whereIn('o.sale_point_id', $salePoints)
            ->orderBy('og.brand_id')
            ->get();
    }

    public function getStatisticsByCategory($date_start, $date_finish, $unit, $salePoints, $categories)
    {
        $unit_condition = $unit === 'count' ? 'SUM(diafan_og.count_goods)': 'SUM(diafan_og.count_goods * diafan_og.price)';

        return DB::connection(env('DB_FH_CONNECTION'))->table('shop_order AS o')
            ->select(
                'og.cat_id AS axisy_id',
                DB::raw('DATE_FORMAT(FROM_UNIXTIME(diafan_o.created),\'%Y/%m\') as date_created'),
                DB::raw($unit_condition.' AS summ')
            )
            ->join(
                DB::raw('(SELECT ogin.good_id, ogin.count_goods, ogin.price, cr.cat_id, ogin.order_id FROM diafan_shop_order_goods ogin'.
                    ' INNER JOIN diafan_shop_category_rel cr ON cr.element_id=ogin.good_id AND cr.cat_id IN'.
                    ' ('.implode(',', array_map(function ($item){ return intval($item); }, $categories)).')) as diafan_og'), function($join){
                $join->on('og.order_id', '=', 'o.id');
            })
            ->groupBy('og.cat_id', 'date_created')
            ->where('o.trash', '0')->whereNotIn('o.status', ['2'])
            ->whereBetween('o.created', [$date_start->timestamp, $date_finish->timestamp])
            ->whereIn('o.sale_point_id', $salePoints)
            ->orderBy('og.cat_id')
            ->get();
    }

    public function getSalePointsById($salePoints_ids):array
    {
        return ShopSalePoint::select('title')->whereIn("id", $salePoints_ids)->orderBy("id")->get()->toArray();
    }

    public function getGoodsByIdForStat($ids_goods):array
    {
        return Goods::select('name1 as title')->whereIn("id", $ids_goods)->orderBy("id")->get()->toArray();
    }

    public function getSellersByIdForStat($ids_users):array
    {
        return DB::connection(env('DB_FH_CONNECTION'))->table('users')->select('name as title')->whereIn("id", $ids_users)->orderBy('id')->get()->toArray();
    }

    public function getBrandsByIdForStat($ids_brands):array
    {
        return Brand::select('name1 as title')->whereIn("id", $ids_brands)->orderBy('id')->get()->toArray();
    }

    public function getCategoriesByIdForStat($ids_categories):array
    {
        return Category::select('name1 as title')->whereIn("id", $ids_categories)->orderBy('id')->get()->toArray();
    }
}
