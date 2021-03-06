<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\SubCategory;
use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $sub_cateogry = SubCategory::inRandomOrder()->first();
    return [
        'brand_id' => null,
        'category_id' =>  $sub_cateogry->category_id,
        'sub_category_id' => $sub_cateogry->id,
        'unit_id' => rand(1,3),
        'name' => $faker->unique()->word(),
        'code' => $faker->uuid,
        'barcode' => $faker->uuid,
        'slug' => $faker->slug,
        'regular_price' => $faker->numberBetween(100, 1000),
        'special_price' => $faker->numberBetween(50, 500),
        'vat_percent' => 0,
        'stock' => $faker->numberBetween(50, 100),
        'is_stock' => 1,
        'is_new' => 0,
        'is_package' => $faker->numberBetween(0,1),
        'is_active' => 1,
        'description' => $faker->sentence
    ];
});

