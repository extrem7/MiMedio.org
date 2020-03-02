<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Post::class, function (Faker $faker) {
    $title = $faker->unique()->sentence;
    return [
        'title' => $title,
        'user_id' => User::all()->random()->id,
        'category_id' => Category::all()->random()->id,
        'excerpt' => $faker->text(140),
        'body' => $faker->realText(1000),
        'status' => Post::PUBLISHED
    ];
});
