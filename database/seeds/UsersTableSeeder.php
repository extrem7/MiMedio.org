<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        User::query()->delete();
        User::create([
            'name' => env('INITIAL_USER_NAME'),
            'email' => env('INITIAL_USER_EMAIL'),
            'password' => env('INITIAL_USER_PASSWORDHASH'),
            'is_admin' => true
        ]);

        factory(User::class, 28)->create()->each(function (User $user) {
            $user->addMediaFromUrl('https://picsum.photos/320/200')
                ->toMediaCollection('avatar');
            $poll = $user->ownPoll()->create(['question' => 'Some question?']);
            $poll->addOptions(['One', 'Two', 'Three'])
                ->maxSelection()
                ->generate();
        });
    }
}
