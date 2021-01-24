<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use App\Models\UserDetails;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'role_id' => null,
        'api_token' => Str::uuid(),
        'username' => $faker->unique()->username,
        'password' => '123456',
        'remember_token' => Str::random(10),
    ];
});

//$factory->afterCreating(User::class, function ($user, Faker $faker) {
//    $user_details = factory(UserDetails::class)->make([
//        'user_id' => $user->id,
//        'user_type_id' => $faker->randomDigitNot(0),
//        'user_service_type_id' => $faker->randomDigitNot(0),
//        'first_name' => $faker->firstName,
//        'last_name' => $faker->lastName,
//        'email' => $faker->unique()->safeEmail,
//        'mobile_no' => $faker->unique()->phoneNumber,
//        'designation' => $faker->jobTitle(),
//        'date_of_birth' => $faker->date($format = 'Y-m-d', $max = 'now'),
//        'joining_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
//        'f_name' => $faker->name('male'),
//        'm_name' => $faker->name('female'),
//        'present_address' => $faker->address,
//        'permanent_address' => $faker->address,
//        'salary' => $faker->numberBetween(3000, 7000),
//    ]);
//    return $user_details->save();
//});
