<?php

namespace App\Http\Controllers;

use App\Http\Service\GoodsService;
use App\Http\Service\Search\SearchService;
use Illuminate\Http\Request;


class SearchController extends Controller
{
    private $searchService;
    private $goodsService;

    public function __construct(SearchService  $searchService, GoodsService $goodsService) {
        $this->searchService = $searchService;
        $this->goodsService = $goodsService;
    }

    public function searchGoodsByName(Request $request):array
    {
        return $this->findGoods($request);
    }

    public function searchCollectionsByName(Request $request):array
    {
        return $this->findGoods($request, true);
    }

    private function findGoods(Request $request, bool $isCollection = false):array
    {
        $goods = [];
        $searchRequest = $request->input('search');
        if($searchRequest)
        {
            $searchIds = $this->searchService->search($searchRequest);
            $goods = $this->goodsService->getGoodsByIds($searchIds, $isCollection);
        }

        return array(
            "view_search" => view("response.goods.search", ['goods' => $goods])->render()
        );
    }
}
