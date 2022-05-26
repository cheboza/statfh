<?php

use App\Http\Service\Search\SearchService;
use App\Model\ShopCounter;
use Tests\TestCase;

class SearchTest extends TestCase {

    private $searchService;

    protected function setUp():void
    {
        parent::setUp();
        $this->artisan('migrate:refresh');
        $this->searchService = app()->get(SearchService::class);

        // создаем тестовые данные
        // заполняем данные по товарам
        factory(ShopCounter::class, 10)->create();
        // сеем данные для поиска
        $this->seed();
    }

    /**
     * Тестируем SearchService
     * Сверяем данные о товарах (element_id), полученных в результате поиска.
     *
     * Поиск должен вернуть 3 результата
     * */
    public function testSearchSuccess3Result()
    {
        $true_array = [1,3,4];
        $testing_array = $this->searchService->search('удачный запрос');
        self::assertTrue($this->arraysAreSimilar($true_array, $testing_array, 'element_id'));
    }

    /**
     * Поиск должен вернуть 1 результат
     * */
    public function testSearchOneResult()
    {
        $true_array = [6];
        $testing_array = $this->searchService->search('jlby htpekmnfn'); // один результат
        self::assertTrue($this->arraysAreSimilar($true_array, $testing_array, 'element_id'));
    }

    /**
     * Поиск должен вернуть 0 результатов
     * */
    public function testSearchNullResult()
    {
        $element_ids = $this->searchService->search('пустой запрос');
        self::assertEmpty($element_ids);

    }

    /**
     * @param array $true_array
     * @param array $testing_array
     * @param string $column_key
     * @return bool
     */
    private function arraysAreSimilar(array $true_array, array $testing_array, string $column_key):bool
    {
        $arr = array_column($testing_array, $column_key);
        $diff = array_diff($true_array, $arr);
        return sizeof($diff) === 0;
    }
}
