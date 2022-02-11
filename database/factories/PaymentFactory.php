<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Payment;
use Faker\Generator as Faker;

$factory->define(Payment::class, function (Faker $faker) {
    return [
        'description' => $faker->sentence(3),
        'discount' => 10,
        'price' => 1000.00,
        'total' => 900.00,
    ];
});
