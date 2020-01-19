<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use\Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {

        // Task №4

        $users = ['Vasia Pupkin', 'Petia Vasilko', 'Oleg Oksamitniy', 'Ignat Igorenko', 'Taras Normas'];
        $usersCount = count($users);


        for ($i = 0; $i < $usersCount; $i++) {
            DB::table('users')->insert([
                'name' => $users[$i],
                'email' => "$users[$i]@gmail.com",
                'password' => Hash::make('password'),
                'created_at' => Carbon::createFromDate(),
            ]);
        }

        for ($i = 1; $i <= 15; $i++) {
            DB::table('images')->insert([
                'url' => 'https://' . Str::random(10) . '.jpg',
            ]);
        }

        for ($i = 1; $i <= 25; $i++) {
            DB::table('posts')->insert([
                'author_id' => random_int(1, $usersCount),
                'image_id' => random_int(1, 15),
                'content' => Str::random(100),
                'created_at' => Carbon::createFromDate(),
            ]);
        }

        for ($i = 1; $i <= 50; $i++) {
            DB::table('comments')->insert([
                'post_id' => random_int(1, 25),
                'commentator_id' => random_int(1, $usersCount),
                'content' => Str::random(35),
                'created_at' => Carbon::createFromDate(),
            ]);
        }
    }
}
