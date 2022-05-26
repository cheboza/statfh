<?php

namespace App\Http\Dao;

use App\Model\Goods;

class GoodsDao
{
    public function getGoodsByIds(array $ids, bool $isCollection)
    {
        return Goods::with('images')->selectRaw("name1, id, is_collection")
            ->whereIn("id", $ids)->where('is_collection', ($isCollection ? '1' : '0'))->paginate(8);
    }
}
