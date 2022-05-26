<?php

namespace App\Http\Service;

use App\Http\Dao\GoodsDao;

class GoodsService
{
    private $goodsDao;
    public function __construct(GoodsDao  $goodsDao)
    {
        $this->goodsDao = $goodsDao;
    }

    public function getGoodsByIds(array $ids, bool $isCollection)
    {
        return $this->goodsDao->getGoodsByIds($ids, $isCollection);
    }
}
