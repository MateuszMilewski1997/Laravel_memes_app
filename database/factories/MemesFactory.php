<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Meme;
use App\Models\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Meme::class, function (Faker $faker) {
    return [
        'created_at' => now(),
        'title' => $faker->title,
        'waiting_room' => 1,
        'user_id' =>  App\User::all()->random()->id,
        'photoPath' => "photo1.jpg",
        'likes' => rand(5, 15),
        'dislikes' => rand(5, 15)
    ];
});
