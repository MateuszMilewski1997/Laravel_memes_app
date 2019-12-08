<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Meme;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'mem_id' => App\Models\Meme::all()->random()->id,
        'content' => $faker->text,
        'user_id' => App\User::all()->random()->id,
    ];
});