<?php

use Illuminate\Database\Seeder;

class GKGame1TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('games')->insert([
            'name' => 'General Knowledge 1',
            'user_id' => '1',
            'description' => '',
            'company' => '',
        ]);

        DB::table('rounds')->insert([
            'game_id' => 2,
            'order_number' => 1,
            'round_type' => 'play',
            'title' => 'A first for everything',
            'time' => 30
        ]);

        DB::table('rounds')->insert([
            'game_id' => 2,
            'order_number' => 2,
            'round_type' => 'play',
            'title' => "You wouldn't believe",
            'time' => 30
        ]);

        DB::table('rounds')->insert([
            'game_id' => 2,
            'order_number' => 3,
            'round_type' => 'play',
            'title' => "Smarty Pants",
            'time' => 30
        ]);

        //question 1
        DB::table('questions')->insert([
            'round_id' => 3,
            'order_number' => 1,
            'title' => 'What was the first theatrical feature film to be completely computer-animated?',
            'type' => 'Multiple-Choice'
        ]);

        DB::table('answers')->insert([
            'question_id' => 5,
            'round_id' => 3,
            'title' => 'The Lion King',
            'correct' => false,
        ]);

        DB::table('answers')->insert([
            'question_id' => 5,
            'round_id' => 3,
            'title' => 'Toy Story',
            'correct' => true,
        ]);

        DB::table('answers')->insert([
            'question_id' => 5,
            'round_id' => 3,
            'title' => "A Bug's Life",
            'correct' => false,
        ]);

        DB::table('answers')->insert([
            'question_id' => 5,
            'round_id' => 3,
            'title' => 'Jimmy Neutron',
            'correct' => false,
        ]);

        //question 2
        DB::table('questions')->insert([
            'round_id' => 3,
            'order_number' => 2,
            'title' => 'What was the first product to have its barcode scanned at purchase?',
            'type' => 'Multiple-Choice'
        ]);
//        answer

        DB::table('answers')->insert([
            'question_id' => 6,
            'round_id' => 3,
            'title' => 'Chewing gum',
            'correct' => true,
        ]);

        DB::table('answers')->insert([
            'question_id' => 6,
            'round_id' => 3,
            'title' => 'Rubik’s Cube',
            'correct' => false,
        ]);

        DB::table('answers')->insert([
            'question_id' => 6,
            'round_id' => 3,
            'title' => 'Apple Pie',
            'correct' => false,
        ]);

        DB::table('answers')->insert([
            'question_id' => 6,
            'round_id' => 3,
            'title' => 'Coca-Cola',
            'correct' => false,
        ]);

        //question 3
        DB::table('questions')->insert([
            'round_id' => 3,
            'order_number' => 3,
            'title' => 'Who was the first U.S. president to enjoy indoor plumbing at the White House?',
            'type' => 'Multiple-Choice'
        ]);

        DB::table('answers')->insert([
            'question_id' => 7,
            'round_id' => 3,
            'title' => 'Andrew Jackson',
            'correct' => true,
        ]);

        DB::table('answers')->insert([
            'question_id' => 7,
            'round_id' => 3,
            'title' => 'Abraham Lincoln',
            'correct' => false,
        ]);

        DB::table('answers')->insert([
            'question_id' => 7,
            'round_id' => 3,
            'title' => 'John Adams',
            'correct' => false,
        ]);

        DB::table('answers')->insert([
            'question_id' => 7,
            'round_id' => 3,
            'title' => 'Thomas Edison',
            'correct' => false,
        ]);


        //round 2 question 1
        DB::table('questions')->insert([
            'round_id' => 4,
            'order_number' => 1,
            'title' => 'Which of these is an actual Winter Olympics event?',
            'type' => 'Multiple-Choice'
        ]);

        DB::table('answers')->insert([
            'question_id' => 8,
            'round_id' => 4,
            'title' => 'Ghostathlon',
            'correct' => false,
        ]);

        DB::table('answers')->insert([
            'question_id' => 8,
            'round_id' => 4,
            'title' => 'Frankensteining',
            'correct' => false,
        ]);

        DB::table('answers')->insert([
            'question_id' => 8,
            'round_id' => 4,
            'title' => 'Water Boarding',
            'correct' => false,
        ]);


        DB::table('answers')->insert([
            'question_id' => 8,
            'round_id' => 4,
            'title' => 'Skeleton',
            'correct' => true,
        ]);

        //round 2 question 2
        DB::table('questions')->insert([
            'round_id' => 4,
            'order_number' => 2,
            'title' => 'Which type of animal has been kept as a White House pet by a U.S. president?',
            'type' => 'Multiple-Choice'
        ]);

        DB::table('answers')->insert([
            'question_id' => 9,
            'round_id' => 4,
            'title' => 'Lemur',
            'correct' => false,
        ]);

        DB::table('answers')->insert([
            'question_id' => 9,
            'round_id' => 4,
            'title' => 'Cow',
            'correct' => true,
        ]);

        DB::table('answers')->insert([
            'question_id' => 9,
            'round_id' => 4,
            'title' => 'Fox',
            'correct' => false,
        ]);

        DB::table('answers')->insert([
            'question_id' => 9,
            'round_id' => 4,
            'title' => 'Sugar Gliders',
            'correct' => false,
        ]);

        //round 2 question 3
        DB::table('questions')->insert([
            'round_id' => 4,
            'order_number' => 3,
            'title' => 'Which of these colleges does NOT have a physical location?',
            'type' => 'Multiple-Choice'
        ]);

        DB::table('answers')->insert([
            'question_id' => 10,
            'round_id' => 4,
            'title' => 'Devry University',
            'correct' => false,
        ]);

        DB::table('answers')->insert([
            'question_id' => 10,
            'round_id' => 4,
            'title' => 'Deep Springs College',
            'correct' => false,
        ]);

        DB::table('answers')->insert([
            'question_id' => 10,
            'round_id' => 4,
            'title' => 'Electoral College',
            'correct' => true,
        ]);

        DB::table('answers')->insert([
            'question_id' => 10,
            'round_id' => 4,
            'title' => 'Hampshire College',
            'correct' => false,
        ]);

        //round 3 question 1
        DB::table('questions')->insert([
            'round_id' => 5,
            'order_number' => 1,
            'title' => 'Fro-yo” is short for what?',
            'type' => 'Fill-in-blank'
        ]);

        DB::table('answers')->insert([
            'question_id' => 11,
            'round_id' => 5,
            'title' => 'Frozen Yogart',
            'correct' => true,
        ]);

        //round 3 question 2
        DB::table('questions')->insert([
            'round_id' => 5,
            'order_number' => 2,
            'title' => "In Shakespeare's play “Julius Caesar,” what phrase does the titular character say to Brutus?",
            'type' => 'Fill-in-blank'
        ]);

        DB::table('answers')->insert([
            'question_id' => 12,
            'round_id' => 5,
            'title' => 'Et tu, Brute?',
            'correct' => true,
        ]);

        //round 3 question 3
        DB::table('questions')->insert([
            'round_id' => 5,
            'order_number' => 3,
            'title' => "What is the deepest part of the ocean called?",
            'type' => 'Fill-in-blank'
        ]);

        DB::table('answers')->insert([
            'question_id' => 13,
            'round_id' => 5,
            'title' => 'Mariana Trench',
            'correct' => true,
        ]);

    }
}
