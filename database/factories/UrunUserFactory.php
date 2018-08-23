<?php

use Faker\Generator as Faker;

$factory->define(App\UrunUser::class, function (Faker $faker) {
    return [
        'user_id' => rand(1,5),
        'urun_id' => rand(1,20),
    ];
});
