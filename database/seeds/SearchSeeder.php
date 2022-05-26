<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SearchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // search_keywords
        $search_keywords_data = [
            ["id" => 1, 'keyword'=>'удачн'],
            ["id" => 2, 'keyword'=>'запрос'],
            ["id" => 3, 'keyword'=>'балбла'],
            ["id" => 4, 'keyword'=>'один'],
            ["id" => 5, 'keyword'=>'результат'],
        ];
        for($i = 6; $i <= 20; $i++)
        {
            $search_keywords_data[] = ["id" => $i, "keyword" => "keyword$i"];
        }
        DB::connection(env('DB_FH_CONNECTION'))->table('search_keywords')->insert($search_keywords_data);

        // search_index
        DB::connection(env('DB_FH_CONNECTION'))->table('search_index')->insert([
            ["id" => 1, 'keyword_id' => 1, 'result_id' => 1, 'rating' => 0],
            ["id" => 2, 'keyword_id' => 2, 'result_id' => 1, 'rating' => 0],
            ["id" => 3, 'keyword_id' => 6, 'result_id' => 2, 'rating' => 0],
            ["id" => 4, 'keyword_id' => 7, 'result_id' => 2, 'rating' => 0],
            ["id" => 5, 'keyword_id' => 8, 'result_id' => 2, 'rating' => 0],
            ["id" => 6, 'keyword_id' => 1, 'result_id' => 5, 'rating' => 0],
            ["id" => 7, 'keyword_id' => 2, 'result_id' => 5, 'rating' => 0],
            ["id" => 8, 'keyword_id' => 10, 'result_id' => 5, 'rating' => 0],
            ["id" => 9, 'keyword_id' => 15, 'result_id' => 3, 'rating' => 0],
            ["id" => 10, 'keyword_id' => 16, 'result_id' => 3, 'rating' => 0],
            ["id" => 11, 'keyword_id' => 17, 'result_id' => 3, 'rating' => 0],
            ["id" => 12, 'keyword_id' => 16, 'result_id' => 11, 'rating' => 0],
            ["id" => 13, 'keyword_id' => 4, 'result_id' => 11, 'rating' => 0],
            ["id" => 14, 'keyword_id' => 5, 'result_id' => 11, 'rating' => 0],
            ["id" => 15, 'keyword_id' => 4, 'result_id' => 6, 'rating' => 0],
            ["id" => 16, 'keyword_id' => 18, 'result_id' => 6, 'rating' => 0],
            ["id" => 17, 'keyword_id' => 20, 'result_id' => 6, 'rating' => 0],
            ["id" => 18, 'keyword_id' => 19, 'result_id' => 7, 'rating' => 0],
            ["id" => 19, 'keyword_id' => 3, 'result_id' => 7, 'rating' => 0],
            ["id" => 20, 'keyword_id' => 15, 'result_id' => 7, 'rating' => 0],
            ["id" => 21, 'keyword_id' => 1, 'result_id' => 8, 'rating' => 0],
            ["id" => 22, 'keyword_id' => 7, 'result_id' => 8, 'rating' => 0],
            ["id" => 23, 'keyword_id' => 2, 'result_id' => 8, 'rating' => 0],
            ["id" => 24, 'keyword_id' => 13, 'result_id' => 8, 'rating' => 0],
            ["id" => 25, 'keyword_id' => 11, 'result_id' => 9, 'rating' => 0],
            ["id" => 26, 'keyword_id' => 17, 'result_id' => 9, 'rating' => 0],
            ["id" => 27, 'keyword_id' => 9, 'result_id' => 10, 'rating' => 0]
        ]);

        // search_results
        DB::connection(env('DB_FH_CONNECTION'))->table('search_results')->insert([
            ['id' => 1, 'element_id' => 1, 'table_name' => 'shop', 'lang_id' => 1, 'access' => '0', 'rating' => 0],
            ['id' => 2, 'element_id' => 2, 'table_name' => 'shop', 'lang_id' => 1, 'access' => '0', 'rating' => 0],
            ['id' => 3, 'element_id' => 100, 'table_name' => 'noshop', 'lang_id' => 1, 'access' => '0', 'rating' => 0],
            ['id' => 4, 'element_id' => 101, 'table_name' => 'noshop', 'lang_id' => 1, 'access' => '0', 'rating' => 0],
            ['id' => 5, 'element_id' => 3, 'table_name' => 'shop', 'lang_id' => 1, 'access' => '0', 'rating' => 0],
            ['id' => 6, 'element_id' => 5, 'table_name' => 'shop', 'lang_id' => 1, 'access' => '0', 'rating' => 0],
            ['id' => 7, 'element_id' => 102, 'table_name' => 'noshop', 'lang_id' => 1, 'access' => '0', 'rating' => 0],
            ['id' => 8, 'element_id' => 4, 'table_name' => 'shop', 'lang_id' => 1, 'access' => '0', 'rating' => 0],
            ['id' => 9, 'element_id' => 7, 'table_name' => 'shop', 'lang_id' => 1, 'access' => '0', 'rating' => 0],
            ['id' => 10, 'element_id' => 103, 'table_name' => 'noshop', 'lang_id' => 1, 'access' => '0', 'rating' => 0],
            ['id' => 11, 'element_id' => 6, 'table_name' => 'shop', 'lang_id' => 1, 'access' => '0', 'rating' => 0],
            ['id' => 12, 'element_id' => 104, 'table_name' => 'noshop', 'lang_id' => 1, 'access' => '0', 'rating' => 0],
            ['id' => 13, 'element_id' => 8, 'table_name' => 'shop', 'lang_id' => 1, 'access' => '0', 'rating' => 0],
            ['id' => 14, 'element_id' => 105, 'table_name' => 'noshop', 'lang_id' => 1, 'access' => '0', 'rating' => 0],
            ['id' => 15, 'element_id' => 10, 'table_name' => 'shop', 'lang_id' => 1, 'access' => '0', 'rating' => 0],
            ['id' => 16, 'element_id' => 9, 'table_name' => 'shop', 'lang_id' => 1, 'access' => '0', 'rating' => 0],
            ['id' => 17, 'element_id' => 106, 'table_name' => 'shop', 'lang_id' => 1, 'access' => '0', 'rating' => 0],
        ]);

    }
}
