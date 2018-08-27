<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'user_id' => rand(1,5),
        'title' => $faker->name,
        'body' => $faker->text,
        'active' => rand(0,1),
    ];
});
