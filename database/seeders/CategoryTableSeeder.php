<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    public function run(): void
    {
        Category::query()->delete();
        Post::query()->delete();
        Category::factory()
            ->has(Post::factory()->count(5), 'posts')
            ->count(10)
            ->create();
    }
}
