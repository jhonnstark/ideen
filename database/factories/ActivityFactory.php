<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Activity;
use Faker\Generator as Faker;

$factory->define(Activity::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(2),
        'description' => $faker->sentence(9),
        'active' => 1,
        'course_id' => 1,
    ];
});
