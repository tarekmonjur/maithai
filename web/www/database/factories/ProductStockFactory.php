<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ProductStock;
use Faker\Generator as Faker;

$factory->define(ProductStock::class, function (Faker $faker) {
    return [
        'product_id' => $faker->randomDigitNot(0),
        'sku_id' => $faker->randomDigitNot(0),
        'stock' => $faker->randomDigitNotNull,
    ];
});
