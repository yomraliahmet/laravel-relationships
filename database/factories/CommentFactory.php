<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    //$array = array('App\Post','App\Video');
    $array = array('post','video');
    $array_rand = array_rand($array,2);
    return [
        'body' => $faker->text,
        'commentable_id' => rand(1,10),
        'commentable_type' => $array[rand(0,1)],
    ];
});
