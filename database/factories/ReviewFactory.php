<?php

use Faker\Generator as Faker;
use App\models\Product;
$factory->define(App\models\Review::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'star' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 5),
        'comment' => $faker->realText($maxNbChars = 200, $indexSize = 2),
        'product_id' => Product::all()->random(),
    ];
});
