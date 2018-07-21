<?php

use Faker\Generator as Faker;

$factory->define(App\models\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph,
        'price' => $faker->numberBetween(100,1000),
        'discount' => $faker->numberBetween(2,20),
        'quantity' => $faker->randomDigit,
        'image'=> $faker->imageUrl($width = 640, $height = 480,'cats'),
    ];
});
