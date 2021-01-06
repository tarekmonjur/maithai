<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Table;
use Faker\Generator as Faker;

$factory->define(Table::class, function (Faker $faker) {
    return [
        'table_no' => uniqid('T'),
        'table_place' => $faker->word,
        'table_qrcode' => $faker->uuid,
    ];
});
