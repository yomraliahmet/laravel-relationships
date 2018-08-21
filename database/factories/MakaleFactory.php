<?php

use Faker\Generator as Faker;

$factory->define(App\Makale::class, function (Faker $faker) {
    return [
        'user_id' => rand(1,5),
        'baslik' => $faker->name,
        'detay' => $faker->text,
    ];
});
