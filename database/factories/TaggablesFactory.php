<?php

use Faker\Generator as Faker;

$factory->define(App\Taggables::class, function (Faker $faker) {
    $array = array('post','video');
    return [
        'tag_id' => rand(1,30),
        'taggable_id' => rand(1,10),
        'taggable_type' => $array[rand(0,1)],
    ];
});
