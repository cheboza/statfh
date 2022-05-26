<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Model\Goods;
use Faker\Generator as Faker;

$factory->define(Goods::class, function (Faker $faker) {
    return [
        'name1' => $faker->name,
        'is_collection' => $faker->randomElement(['0', '1']),
        'descr1' => $faker->sentence(20, true),
        'title_meta1' => $faker->sentence(8, true),
        'sort' => $faker->randomNumber(),
        'timeedit' => time(),
    ];
});
