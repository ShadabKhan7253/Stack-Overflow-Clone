<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Shadab Khan ',
            'email' => 'shadabkhan@gmail.com',
            'password' => Hash::make('abcd1234')
        ]);

        \App\Models\User::factory(10)->create()->each(function($user) {
                $user->questions()->saveMany(
                    Question::factory(random_int(5,10))->make()
                    )->each(function($question) {
                        $question->answer()->saveMany(
                            Answer::factory(random_int(2,8))->make()
                        );
                    });
        });

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
