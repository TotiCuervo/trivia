<?php

use Illuminate\Database\Seeder;

class GameTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('games')->insert([
            'name' => 'Game of Thrones',
            'user_id' => '1',
            'description' => 'Winter is Coming',
            'company' => 'Railgarten',
        ]);

        DB::table('rounds')->insert([
            'game_id' => 1,
            'order_number' => 1,
            'round_type' => 'play',
            'title' => 'Fill in the Blank',
            'time' => 60
        ]);

        DB::table('rounds')->insert([
            'game_id' => 1,
            'order_number' => 2,
            'round_type' => 'play',
            'title' => 'Multiple Choice',
            'time' => 60
        ]);

        //question 1
        DB::table('questions')->insert([
            'round_id' => 1,
            'order_number' => 1,
            'title' => 'What is the Iron Bank’s representative, played by Mark Gatiss, called?',
            'type' => 'Fill-in-blank'
        ]);

        DB::table('answers')->insert([
            'question_id' => 1,
            'round_id' => 1,
            'title' => 'Quorin Halfhand',
            'correct' => true,
        ]);

        DB::table('answers')->insert([
            'question_id' => 1,
            'round_id' => 1,
            'title' => 'Xaro Xhoan Daxon',
            'correct' => true,
        ]);

        DB::table('answers')->insert([
            'question_id' => 1,
            'round_id' => 1,
            'title' => 'Howard from the Halifax',
            'correct' => true,
        ]);

        DB::table('answers')->insert([
            'question_id' => 1,
            'round_id' => 1,
            'title' => 'Tycho Nestoris',
            'correct' => true,
        ]);

        //question 2
        DB::table('questions')->insert([
            'round_id' => 1,
            'order_number' => 2,
            'title' => 'Who was responsible for the creation of the Night King?',
            'type' => 'Fill-in-blank'
        ]);

        DB::table('answers')->insert([
            'question_id' => 2,
            'round_id' => 1,
            'title' => 'The Lord of Light',
            'correct' => true,
        ]);

        DB::table('answers')->insert([
            'question_id' => 2,
            'round_id' => 1,
            'title' => 'The Children of the Forest',
            'correct' => true,
        ]);

        DB::table('answers')->insert([
            'question_id' => 2,
            'round_id' => 1,
            'title' => 'The Drowned God',
            'correct' => true,
        ]);

        DB::table('answers')->insert([
            'question_id' => 2,
            'round_id' => 1,
            'title' => 'The First Men',
            'correct' => true,
        ]);


        //round 2 question 1
        DB::table('questions')->insert([
            'round_id' => 2,
            'order_number' => 1,
            'title' => 'In the TV show, what was Hodor called before he got his tragic door-holding nickname?',
            'type' => 'Multiple-Choice'
        ]);

        DB::table('answers')->insert([
            'question_id' => 3,
            'round_id' => 2,
            'title' => 'Wylis',
            'correct' => true,
        ]);

        DB::table('answers')->insert([
            'question_id' => 3,
            'round_id' => 2,
            'title' => 'Horys',
            'correct' => false,
        ]);

        DB::table('answers')->insert([
            'question_id' => 3,
            'round_id' => 2,
            'title' => 'Myrys',
            'correct' => false,
        ]);

        DB::table('answers')->insert([
            'question_id' => 3,
            'round_id' => 2,
            'title' => 'Gladys',
            'correct' => false,
        ]);

        //round 2 question 2
        DB::table('questions')->insert([
            'round_id' => 2,
            'order_number' => 2,
            'title' => 'Who was the leader of the Golden Company sellswords when Dany ransacked King’s Landing?',
            'type' => 'Multiple-Choice'
        ]);

        DB::table('answers')->insert([
            'question_id' => 4,
            'round_id' => 2,
            'title' => 'Wes Borland',
            'correct' => true,
        ]);

        DB::table('answers')->insert([
            'question_id' => 4,
            'round_id' => 2,
            'title' => 'Harry Strickland',
            'correct' => false,
        ]);

        DB::table('answers')->insert([
            'question_id' => 4,
            'round_id' => 2,
            'title' => 'Kiefer Sutherland',
            'correct' => false,
        ]);

        DB::table('answers')->insert([
            'question_id' => 4,
            'round_id' => 2,
            'title' => 'Robert Westland',
            'correct' => false,
        ]);



    }
}
