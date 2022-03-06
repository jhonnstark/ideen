<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Cycle;
use Faker\Generator as Faker;

$factory->define(Cycle::class, function (Faker $faker) {
    return [
        'name' => $faker->year . '/' . $faker->year,
    ];
});
