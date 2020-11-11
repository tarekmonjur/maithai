<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\SubCategory;
use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(SubCategory::class, function (Faker $faker) {
    return [
        'category_id' => factory(Category::class),
        'name' => $faker->unique()->word,
        'slug' => $faker->unique()->slug,
    ];
});
