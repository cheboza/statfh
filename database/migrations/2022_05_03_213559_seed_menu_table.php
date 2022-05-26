<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SeedMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('menu')->insert(
           [
               ['name' => 'Магазины', 'link' => '/shop',  'title'=>'Статистика по магазинам'],
               ['name' => 'Товары', 'link' => '/goods',  'title'=>'Статистика по товарам'],
               ['name' => 'Коллекции', 'link' => '/collections',  'title'=>'Статистика по коллекциям'],
               ['name' => 'Продавцы', 'link' => '/sellers', 'title'=>'Статистика по продавцам'],
               ['name' => 'Фабрики', 'link' => '/brands', 'title'=>'Статистика по фабрикам'],
               ['name' => 'Категории', 'link' => '/categories', 'title'=>'Статистика по категориям']
           ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('menu')->truncate();
    }
}
