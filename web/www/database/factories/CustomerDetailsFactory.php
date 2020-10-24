<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Customer;
use App\Models\CustomerDetails;
use Faker\Generator as Faker;

$factory->define(CustomerDetails::class, function (Faker $faker) {
    return [
        'customer_id' => factory(Customer::class),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'mobile_no' => $faker->phoneNumber,
        'city' => $faker->city,
        'state' => $faker->state,
        'zip_code' => $faker->postcode,
        'address' => $faker->address,
    ];
});
