<?php

use Faker\Generator as Faker;

$factory->define(App\Ozgecmis::class, function (Faker $faker) {
    return [
        'user_id' => rand(1,5),
        'isim' => $faker->name,
        'soyisim' => $faker->name,
        'sehir' => str_random(10),
        'meslek' => str_random(10),
    ];
});
