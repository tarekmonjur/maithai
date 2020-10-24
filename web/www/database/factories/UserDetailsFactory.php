<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use App\Models\UserDetails;
use Faker\Generator as Faker;

$factory->define(UserDetails::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'user_type_id' => $faker->randomDigitNot(0),
        'user_service_type_id' => $faker->randomDigitNot(0),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'mobile_no' => $faker->unique()->phoneNumber,
        'designation' => $faker->jobTitle(),
        'date_of_birth' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'joining_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'f_name' => $faker->name('male'),
        'm_name' => $faker->name('female'),
        'present_address' => $faker->address,
        'permanent_address' => $faker->address,
        'salary' => $faker->numberBetween(3000, 7000),
    ];
});
