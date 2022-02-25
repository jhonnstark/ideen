<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Finance;
use Faker\Generator as Faker;

$factory->define(Finance::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => 'finance@finance.com',
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
