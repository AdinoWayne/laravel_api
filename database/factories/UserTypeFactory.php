<?php

use Faker\Generator as Faker;

$factory->define(App\User_Type::class, function (Faker $faker) {
    return [
        'user_type_name' => $faker->realText($maxNbChars = 20, $indexSize = 2)
    ];
});
