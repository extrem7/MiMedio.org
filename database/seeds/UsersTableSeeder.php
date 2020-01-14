<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
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
        User::create([
            'name' => 'John Doe',
            'email' => 'example@mimedio.com',
            'password' => Hash::make('2705921')
        ]);
    }
}
