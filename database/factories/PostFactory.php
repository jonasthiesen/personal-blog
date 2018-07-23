<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title'   => $faker->slug,
        'user_id' => 0,
        'content' => $faker->text,
    ];
});
