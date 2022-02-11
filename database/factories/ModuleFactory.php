<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Module;
use Faker\Generator as Faker;

$factory->define(Module::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(2),
        'description' => $faker->sentence(6),
        'course_id' => 1,
    ];
});
