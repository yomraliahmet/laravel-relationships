<?php

use Faker\Generator as Faker;

$factory->define(App\Urun::class, function (Faker $faker) {
    return [
        'urunadi' => $faker->name,
        'adet' => rand(1,500),
        'fiyat' => rand(50,500),
    ];
});
