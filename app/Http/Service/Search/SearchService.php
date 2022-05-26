<?php

namespace App\Http\Service\Search;

use App\Facades\SearchWords;
use App\Http\Dao\SearchDao;

class SearchService
{
    private $searchWordHandler;
    private $searchDao;

    public function __construct(SearchWordHandler $searchWordHandler, SearchDao $searchDao)
    {
        $this->searchWordHandler = $searchWordHandler;
        $this->searchDao = $searchDao;
    }

    /**
     * Start search
     *
     * @param string $request
     * @return array
     */
    public function search(string $request): array
    {
        $arraySearchStems = SearchWords::getUniqueStemWords($request);
        // получение существующих ключей из приложения
        $keys = $this->searchDao->getKeywords($arraySearchStems)->toArray();

        $arrayDiff = array_diff($arraySearchStems, array_column($keys, 'keyword'));

        foreach ($arrayDiff as $diff) {
            $handledKey = $this->searchWordHandler->handle($diff);
            if (!empty($handledKey)) {
                foreach ($handledKey as $hKey) {
                    $keys[] = $hKey;
                }
            } else {
                return [];
            }
        }

        return $this->searchDao->getResultSearch(array_column($keys, 'id'));
    }
}
