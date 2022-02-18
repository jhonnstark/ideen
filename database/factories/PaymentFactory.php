<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Payment;
use Faker\Generator as Faker;

$factory->define(Payment::class, function (Faker $faker) {
    return [
        'invoice' => $faker->sentence(3),
        'signing_up' => 1040.00,
        'price' => 300.00,
        'discount' => 10,
        'scholarship' => 10,
        'total' => 900.00,
    ];
});
