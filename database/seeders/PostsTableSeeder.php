<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=PostsTableSeeder
     *
     * @return void
     */
    public function run(): void
    {
        $users = User::take(5)->get();
        /*
        factory(Post::class, (int)env('POSTS_SEEDER_COUNT', 250))->create()->each(function (Post $post) use ($users) {
            $users->each(function (User $user) use ($post) {
                $post->likesRaw()->create([
                    'user_id' => $user->id,
                    'dislike' => (bool)random_int(0, 1)
                ]);

                factory(Comment::class, 1)->create([
                    'user_id' => $user->id,
                    'post_id' => $post->id
                ])->each(function (Comment $comment) use ($user, $post) {
                   factory(Comment::class, 1)->create([
                        'user_id' => $user->id,
                        'post_id' => $post->id,
                        'parent_id' => $comment->id
                    ]);
                });
            });
            $post->addMediaFromUrl('https://picsum.photos/750/370')->toMediaCollection('image');
        });
        */
        User::all()->each(function (User $user) {
            $user->shared()->attach(Post::all()->random(5));
        });
    }
}
