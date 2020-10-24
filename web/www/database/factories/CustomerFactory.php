<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Customer;
use Faker\Generator as Faker;
use \Illuminate\Support\Str;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'access_token' => Str::uuid(),
        'username' => $faker->unique()->username,
        'password' => bcrypt(123456),
        'remember_token' => Str::random(10),
        'referral_code' => $faker->unique()->randomNumber(),
        'email_verified' => 1,
        'email_verified_at' => $faker->dateTime(),
    ];
});
