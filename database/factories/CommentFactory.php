<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Comment::class, function (Faker $faker) {
    return [
        'text' => $faker->text(140)
    ];
});
