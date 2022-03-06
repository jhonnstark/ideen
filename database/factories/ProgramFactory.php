<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Program;
use Faker\Generator as Faker;

$factory->define(Program::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'quarts' => random_int(1,6),
        'periods' => random_int(1, 3),
    ];
});
