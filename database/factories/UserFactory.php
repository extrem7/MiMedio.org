<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'remember_token' => \Str::random(10),
            /* 'color' => collect(['6d9eeb', 'e06666', '6aa84f', '741b47'])->random(),
             'embed' => [
                 'facebook' => '<div class="fb-page" data-href="https://www.facebook.com/facebook" data-tabs="" data-width="" data-height="250" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/facebook" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/facebook">Facebook</a></blockquote></div>',
                 'twitter' => '<a class="twitter-timeline" data-theme="light" href="https://twitter.com/TwitterDev/lists/national-parks?ref_src=twsrc%5Etfw">A Twitter List by TwitterDev</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>'
             ]*/
        ];
    }
}
