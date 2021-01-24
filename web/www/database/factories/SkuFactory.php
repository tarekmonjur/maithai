<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Sku;
use Faker\Generator as Faker;

$factory->define(Sku::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word(),
        'code' => $faker->uuid,
        'location' => $faker->sentence,
        'description' => $faker->sentence
    ];
});
