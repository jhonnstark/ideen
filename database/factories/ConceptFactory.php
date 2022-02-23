<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Concept;
use Faker\Generator as Faker;

$factory->define(Concept::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(2),
        'total' => random_int(2, 100),
    ];
});
