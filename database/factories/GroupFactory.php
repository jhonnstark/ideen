<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Group;
use Faker\Generator as Faker;

$factory->define(Group::class, function (Faker $faker) {
    return [
        'name' => $faker->postcode,
        'quart' => random_int(1,6),
        'period' => random_int(1, 3),
        'program_id' => 1,
        'cycle_id' => 1,
    ];
});
