<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Meme;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Meme::class, function (Faker $faker) {
    return [
        'created_at' => now(),
        'title' => $faker->title,
        'waiting_room' => 1,
        'user_id' => 1,
        'photoPath' => "photo1.jpg",
        'likes' => 0,
        'dislikes' => 0
    ];
});
