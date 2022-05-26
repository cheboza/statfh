<?php

namespace App\Http\Dao;

use App\Model\SearchKeyword;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class SearchDao
{
    public function getKeywords(array $keys):Collection
    {
        return SearchKeyword::selectRaw("id, keyword")->whereIn('keyword', $keys)->get();
    }

    public function getResultSearch(array $keywordIds):array
    {
        $joinIndex = '';
        $k=0;

        foreach ($keywordIds as $key) {
            $joinIndex .= " INNER JOIN diafan_search_index AS i" . $k . " ON r.id=i" . $k . ".result_id AND i" . $k++ . ".keyword_id=?";
        }

        $querySelect = "SELECT r.element_id FROM diafan_search_results as r "
            ." INNER JOIN diafan_shop_counter AS c ON c.element_id=r.element_id AND c.trash='0'"
            .$joinIndex. " WHERE r.table_name='shop' AND r.access='0'"
            . " GROUP BY r.id ORDER BY c.count_view DESC";

        $result = DB::connection(env('DB_FH_CONNECTION'))->select($querySelect, $keywordIds);
        return json_decode(json_encode($result), true);
    }
}
