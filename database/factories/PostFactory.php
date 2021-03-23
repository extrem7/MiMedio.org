<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Comment::class;

    public function definition(): array
    {
        $title = $this->faker->unique()->sentence;
        return [
            'title' => $title,
            'user_id' => User::all()->random()->id,
            'category_id' => Category::all()->random()->id,
            'excerpt' => $this->faker->text(140),
            'body' => $this->faker->realText(1000),
            'status' => Post::PUBLISHED
        ];
    }
}
