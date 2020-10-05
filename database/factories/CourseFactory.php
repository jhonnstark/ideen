<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Course;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(2),
        'active' => 1,
        'category_id' => 1,
        'level_id' => 1,
    ];
});
