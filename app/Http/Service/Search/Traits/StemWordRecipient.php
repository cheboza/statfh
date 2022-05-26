<?php

namespace App\Http\Service\Search\Traits;

use App\Facades\SearchWords;
use App\Http\Dao\SearchDao;

// Получатель ключей из корней
trait StemWordRecipient
{

    /**
     * По входящему запросу определяем корни, по которым ищем ключи в БД
     *
     * @param string $searchWord
     * @return array
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getKeysByStemWord(string $searchWord):?array
    {
        if(!empty($searchWord))
        {
            $keyHandled = SearchWords::getUniqueStemWords($searchWord);

            $searchDao = app()->make(SearchDao::class);
            $key = $searchDao->getKeywords($keyHandled)->toArray();
            return (!empty($key) ? $key : null);
        }
        return null;
    }
}
