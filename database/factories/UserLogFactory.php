<?php

use Faker\Generator as Faker;
use App\User;

$factory->define(App\Models\User_Log::class, function (Faker $faker) {
    return [
        'id' => $faker->factory('App\User')->create()->id,
        'last_login_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'last_job_apply_date' => $faker->date($format = 'Y-m-d', $max = 'now')
    ];
});
