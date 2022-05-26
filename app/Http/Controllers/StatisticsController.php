<?php

namespace App\Http\Controllers;

use App\Http\Service\StatisticsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    /**
     * @var StatisticsService
     */
    private $statisticService;

    /**
     * @param StatisticsService $statisticService
     */
    public function __construct(StatisticsService $statisticService)
    {
        $this->statisticService = $statisticService;
    }

    /**
     * Получение статистики по магазинам (точкам продаж)
     * */
    public function shopStat(Request $request): JsonResponse
    {
        $countMonth = $request->input('rang', 6) - 1;
        $response = $this->statisticService->getShopStatistic($countMonth);

        return response()->json($response, 200);
    }

    /**
     * Получение статистики по товарам
     * */
    public function goodsStat(Request $request):JsonResponse
    {
        $countMonth = $request->input('rang', 6) - 1;
        $unit = $request->input('unit', 'count');
        $salePoints = $request->input('points', []);
        $idsGoods = $request->input('goods', []);

        $response = $this->statisticService->getGoodsStatistic($countMonth, $unit, $salePoints, $idsGoods);

        return response()->json($response, 200);
    }

    public function collectionsStat(Request $request):JsonResponse
    {
        $countMonth = $request->input('rang', 6) - 1;
        $unit = $request->input('unit', 'count');
        $salePoints = $request->input('points', []);
        $ids_collections = $request->input('goods', []);

        $response = $this->statisticService->getCollectionsStatistic($countMonth, $unit, $salePoints, $ids_collections);

        return response()->json($response, 200);
    }

    public function sellersStat(Request $request):JsonResponse
    {
        $countMonth = $request->input('rang', 6) - 1;
        $unit = $request->input('unit', 'count');
        $salePoints = $request->input('points', []);

        $response = $this->statisticService->getSellersStatistic($countMonth, $unit, $salePoints);

        return response()->json($response, 200);
    }

    public function brandsStat(Request $request):JsonResponse
    {
        $countMonth = $request->input('rang', 6) - 1;
        $unit = $request->input('unit', 'count');
        $salePoints = $request->input('points', []);
        $brands = $request->input('brands', []);

        $response = $this->statisticService->getBrandsStatistic($countMonth, $unit, $salePoints, $brands);

        return response()->json($response, 200);
    }

    public function categoriesStat(Request $request):JsonResponse
    {
        $countMonth = $request->input('rang', 6) - 1;
        $unit = $request->input('unit', 'count');
        $salePoints = $request->input('points', []);
        $categories = $request->input('categories', []);

        $response = $this->statisticService->getCategoriesStatistic($countMonth, $unit, $salePoints, $categories);

        return response()->json($response, 200);
    }
}
