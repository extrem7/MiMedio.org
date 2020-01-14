<?php

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::query()->delete();
        Post::query()->delete();
        factory(Category::class, 20)->create()->each(function (Category $category) {
            $category->posts()->saveMany(factory(Post::class, 5)->make());
        });;
    }
}
