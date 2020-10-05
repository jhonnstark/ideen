<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\State;
use App\Models\User;
use App\Models\UserProfile;
use Faker\Generator as Faker;

$factory->define(UserProfile::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'state_id' => 9,
    ];
});
