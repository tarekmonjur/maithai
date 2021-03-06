<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ProductVariant;
use App\Models\Variant;
use Faker\Generator as Faker;

$factory->define(ProductVariant::class, function (Faker $faker) {
    $variant = Variant::with('subVariants')->inRandomOrder()->first();
    return [
        'product_id' => $faker->randomDigitNot(0),
        'variant_id' => $variant->id,
        'sub_variant_id' => $variant->subVariants[rand(0,2)]->id,
        'additional_price' => $faker->numberBetween(10, 100),
    ];
});
