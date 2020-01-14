<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Illuminate\Support\Str;
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
        'slug' => Str::slug($title),
        'user_id' => \App\Models\User::where('email', 'raxkor.dev@gmail.com')->first()->id,
        'excerpt' => $faker->text(50),
        'body' => $faker->realText(),
        'status' => (bool)random_int(0, 1) ? Post::PUBLISHED : Post::DRAFT];
});
