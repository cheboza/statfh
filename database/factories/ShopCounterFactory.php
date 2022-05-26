<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Goods;
use App\Model\ShopCounter;
use Faker\Generator as Faker;

$factory->define(ShopCounter::class, function (Faker $faker) {
    return [
        'element_id' => factory(Goods::class)->create()->id,
        'count_view' => $faker->randomNumber(),
        'trash' =>  '0'
    ];
});
