<?php

use Faker\Generator as Faker;
use App\Services\Member\Models\User;

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
        'avatar' => $faker->imageUrl(),
        'nick_name' => $faker->firstName . mt_rand(0, 100),
        'email' => $faker->email,
        'password' => \Illuminate\Support\Facades\Hash::make('123456'),
        'credit1' => mt_rand(0, 10000),
        'credit2' => mt_rand(0, 10000),
        'credit3' => mt_rand(0, 10000),
        'is_active' => $faker->randomElement([User::ACTIVE_NO, User::ACTIVE_YES]),
        'is_lock' => $faker->randomElement([User::LOCK_NO, User::LOCK_YES]),
        'role_id' => 0,
        'role_expired_at' => \Carbon\Carbon::now(),
    ];
});
