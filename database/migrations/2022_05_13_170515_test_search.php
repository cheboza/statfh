<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TestSearch extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (env('APP_ENV') == 'testing') {
            if (!Schema::connection(env('DB_FH_CONNECTION'))->hasTable('shop')) {
                Schema::connection(env('DB_FH_CONNECTION'))->create('shop', function (Blueprint $table) {
                    $table->bigIncrements('id');
                    $table->string('name1');
                    $table->enum('is_collection', [0, 1]);
                    $table->string('descr1');
                    $table->string('title_meta1');
                    $table->integer('sort');
                    $table->integer('timeedit');
                });
            }

            if (!Schema::connection(env('DB_FH_CONNECTION'))->hasTable('search_index')) {
                Schema::connection(env('DB_FH_CONNECTION'))->create('search_index', function (Blueprint $table) {
                    $table->bigIncrements('id');
                    $table->integer('keyword_id');
                    $table->integer('result_id');
                    $table->tinyInteger('rating');
                });
            }

            if (!Schema::connection(env('DB_FH_CONNECTION'))->hasTable('search_keywords')) {
                Schema::connection(env('DB_FH_CONNECTION'))->create('search_keywords', function (Blueprint $table) {
                    $table->bigIncrements('id');
                    $table->string('keyword');
                });
            }

            if (!Schema::connection(env('DB_FH_CONNECTION'))->hasTable('search_results')) {
                Schema::connection(env('DB_FH_CONNECTION'))->create('search_results', function (Blueprint $table) {
                    $table->bigIncrements('id');
                    $table->integer('element_id');
                    $table->string('table_name');
                    $table->tinyInteger('lang_id');
                    $table->enum('access', [0, 1]);
                    $table->tinyInteger('rating');
                });
            }

            if (!Schema::connection(env('DB_FH_CONNECTION'))->hasTable('shop_counter')) {
                Schema::connection(env('DB_FH_CONNECTION'))->create('shop_counter', function (Blueprint $table) {
                    $table->bigIncrements('id');
                    $table->integer('element_id');
                    $table->integer('count_view');
                    $table->enum('trash', [0, 1]);
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (env('APP_ENV') == 'testing') {
            Schema::connection(env('DB_FH_CONNECTION'))->dropIfExists('shop');
            Schema::connection(env('DB_FH_CONNECTION'))->dropIfExists('search_index');
            Schema::connection(env('DB_FH_CONNECTION'))->dropIfExists('search_keywords');
            Schema::connection(env('DB_FH_CONNECTION'))->dropIfExists('search_results');
            Schema::connection(env('DB_FH_CONNECTION'))->dropIfExists('shop_counter');
        }
    }
}
