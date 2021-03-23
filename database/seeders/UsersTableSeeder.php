<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Polls\Poll;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Exception
     */
    public function run(): void
    {
        User::factory()
            ->count(10)
            ->create()
            ->each(function (User $user) {
                $user->addMediaFromUrl('https://picsum.photos/320/200')
                    ->toMediaCollection('avatar');
                $user->playlist()->create([
                    'title' => $user->name . ' TV',
                    'videos' => [
                        ['title' => 'КИТАЕЦ ПРОТИВ СТОЛБА. ЛУЧШЕ ГРАНТЫ ?', 'id' => 'VDrXI5DjdsQ', 'duration' => '12:55'],
                        ['title' => 'Защита информации в сети', 'id' => '4oLzvhDRZT4', 'duration' => '2:33:02']
                    ]
                ]);

                /* @var $poll Poll */
                $poll = $user->ownPoll()->create(['question' => 'Some question?']);
                $poll->addOptions(['One', 'Two', 'Three'])
                    ->maxSelection()
                    ->generate();
            });

        User::all()->each(function (User $user) {
            $user->followings()->attach(User::all()->random(10));
        });
    }
}
