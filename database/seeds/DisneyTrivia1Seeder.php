<?php

use Illuminate\Database\Seeder;

class DisneyTrivia1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('games')->insert([
            'name' => 'Disney Trivia 1',
            'user_id' => '1',
            'description' => '',
            'company' => '',
        ]);

        DB::table('rounds')->insert([
            'game_id' => 4,
            'order_number' => 1,
            'round_type' => 'play',
            'title' => "Disney is everywhere",
            'time' => 60
        ]);

        DB::table('rounds')->insert([
            'game_id' => 4,
            'order_number' => 2,
            'round_type' => 'play',
            'title' => "What movie is this?",
            'time' => 60
        ]);

        DB::table('rounds')->insert([
            'game_id' => 4,
            'order_number' => 3,
            'round_type' => 'play',
            'title' => "No, I'm the biggest fan!",
            'time' => 60
        ]);

        //question 1
        DB::table('questions')->insert([
            'round_id' => 9,
            'order_number' => 1,
            'title' => "Who is the most famous Disney Character?",
            'type' => 'Fill-in-blank'
        ]);

        DB::table('answers')->insert([
            'question_id' => 23,
            'round_id' => 9,
            'title' => 'Mickey Mouse',
            'correct' => true,
        ]);

        //question 2
        DB::table('questions')->insert([
            'round_id' => 9,
            'order_number' => 2,
            'title' => "Which of these does Disney not own?",
            'type' => 'Multiple-Choice'
        ]);

        DB::table('answers')->insert([
            'question_id' => 24,
            'round_id' => 9,
            'title' => 'National Geographic',
            'correct' => false,
        ]);

        DB::table('answers')->insert([
            'question_id' => 24,
            'round_id' => 9,
            'title' => '20th Century Fox',
            'correct' => false,
        ]);

        DB::table('answers')->insert([
            'question_id' => 24,
            'round_id' => 9,
            'title' => 'HBO',
            'correct' => true,
        ]);

        DB::table('answers')->insert([
            'question_id' => 24,
            'round_id' => 9,
            'title' => 'ABC Family',
            'correct' => false,
        ]);

        //question 3
        DB::table('questions')->insert([
            'round_id' => 9,
            'order_number' => 3,
            'title' => "Which of these is not a Disney Movie?",
            'type' => 'Multiple-Choice'
        ]);

        DB::table('answers')->insert([
            'question_id' => 25,
            'round_id' => 9,
            'title' => 'Men In Black',
            'correct' => true,
        ]);

        DB::table('answers')->insert([
            'question_id' => 25,
            'round_id' => 9,
            'title' => 'Pirates of the Caribbean: The Curse of the Black Pearl',
            'correct' => false,
        ]);

        DB::table('answers')->insert([
            'question_id' => 25,
            'round_id' => 9,
            'title' => 'The Princess Diaries',
            'correct' => false,
        ]);

        DB::table('answers')->insert([
            'question_id' => 25,
            'round_id' => 9,
            'title' => 'Home Alone',
            'correct' => false,
        ]);

        //round 2 question 1
        DB::table('questions')->insert([
            'round_id' => 10,
            'order_number' => 1,
            'title' => '"Ohana means family. Family means nobody gets left behind or forgotten"',
            'type' => 'Fill-in-blank'
        ]);

        DB::table('answers')->insert([
            'question_id' => 26,
            'round_id' => 9,
            'title' => 'Lilo and Stitch',
            'correct' => true,
        ]);

        //round 2 question 2
        DB::table('questions')->insert([
            'round_id' => 10,
            'order_number' => 2,
            'title' => '"Being brave doesn\'t mean you go looking for trouble."',
            'type' => 'Fill-in-blank'
        ]);

        DB::table('answers')->insert([
            'question_id' => 27,
            'round_id' => 10,
            'title' => 'The Lion King',
            'correct' => true,
        ]);


        //round 2 question 3
        DB::table('questions')->insert([
            'round_id' => 10,
            'order_number' => 3,
            'title' => "\"Better look first, for if one drinks much from a bottle marked 'Poison,' it's almost certain to disagree with you sooner or later.\"",
            'type' => 'Multiple-Choice'
        ]);

        DB::table('answers')->insert([
            'question_id' => 28,
            'round_id' => 10,
            'title' => 'Sleeping Beauty',
            'correct' => false,
        ]);

        DB::table('answers')->insert([
            'question_id' => 28,
            'round_id' => 10,
            'title' => 'Tangled',
            'correct' => false,
        ]);

        DB::table('answers')->insert([
            'question_id' => 28,
            'round_id' => 10,
            'title' => 'Alice in Wonderland',
            'correct' => true,
        ]);

        DB::table('answers')->insert([
            'question_id' => 28,
            'round_id' => 10,
            'title' => "The Emperor's New Groove",
            'correct' => false,
        ]);


        //round 3 question 1
        DB::table('questions')->insert([
            'round_id' => 11,
            'order_number' => 1,
            'title' => 'Name one of the top 3 highest grossing Animated Disney films',
            'type' => 'Fill-in-blank'
        ]);

        DB::table('answers')->insert([
            'question_id' => 29,
            'round_id' => 11,
            'title' => 'The Lion King (2019)',
            'correct' => true,
        ]);

        DB::table('answers')->insert([
            'question_id' => 29,
            'round_id' => 11,
            'title' => 'Frozen',
            'correct' => true,
        ]);

        DB::table('answers')->insert([
            'question_id' => 29,
            'round_id' => 11,
            'title' => 'Incredibles 2',
            'correct' => true,
        ]);

        //round 3 question 2
        DB::table('questions')->insert([
            'round_id' => 11,
            'order_number' => 2,
            'title' => "What is the only Disney song to win a Grammy Award for Song of the Year?",
            'type' => 'Multiple-Choice'
        ]);

        DB::table('answers')->insert([
            'question_id' => 30,
            'round_id' => 11,
            'title' => 'Let It Go',
            'correct' => false,
        ]);

        DB::table('answers')->insert([
            'question_id' => 30,
            'round_id' => 11,
            'title' => 'Can You Feel The Love Tonight',
            'correct' => false,
        ]);

        DB::table('answers')->insert([
            'question_id' => 30,
            'round_id' => 11,
            'title' => "You'll Be In My Heart",
            'correct' => false,
        ]);

        DB::table('answers')->insert([
            'question_id' => 30,
            'round_id' => 11,
            'title' => 'A Whole New World',
            'correct' => true,
        ]);


        //round 3 question 3
        DB::table('questions')->insert([
            'round_id' => 11,
            'order_number' => 3,
            'title' => "Which of these was the first Disney Animated Movie?",
            'type' => 'Multiple-Choice'
        ]);

        DB::table('answers')->insert([
            'question_id' => 31,
            'round_id' => 11,
            'title' => 'Snow White and the Seven Dwarfs',
            'correct' => true,
        ]);

        DB::table('answers')->insert([
            'question_id' => 31,
            'round_id' => 11,
            'title' => 'Cinderella',
            'correct' => false,
        ]);

        DB::table('answers')->insert([
            'question_id' => 31,
            'round_id' => 11,
            'title' => 'Pinocchio',
            'correct' => false,
        ]);

        DB::table('answers')->insert([
            'question_id' => 31,
            'round_id' => 11,
            'title' => 'Bambi',
            'correct' => false,
        ]);

    }
}
