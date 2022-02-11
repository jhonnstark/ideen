<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Content;
use Faker\Generator as Faker;

$factory->define(Content::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(2),
        'description' => $faker->sentence(9),
        'module_id' => 1,
    ];
});
