<?php

use Illuminate\Database\Seeder;

class YugiohSeason1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('games')->insert([
            'name' => 'Yugioh Season 1',
            'user_id' => '1',
            'description' => '',
            'company' => '',
        ]);

        DB::table('rounds')->insert([
            'game_id' => 3,
            'order_number' => 1,
            'round_type' => 'play',
            'title' => 'What happened?',
            'time' => 15
        ]);

        DB::table('rounds')->insert([
            'game_id' => 3,
            'order_number' => 2,
            'round_type' => 'play',
            'title' => "Name That Character",
            'time' => 30
        ]);

        DB::table('rounds')->insert([
            'game_id' => 3,
            'order_number' => 3,
            'round_type' => 'play',
            'title' => "Heart of the cards",
            'time' => 15
        ]);

        //question 1
        DB::table('questions')->insert([
            'round_id' => 6,
            'order_number' => 1,
            'title' => "What did Pegasus do to yugi's grandpa?",
            'type' => 'Multiple-Choice'
        ]);

        DB::table('answers')->insert([
            'question_id' => 14,
            'round_id' => 6,
            'title' => 'Kill Him',
            'correct' => false,
        ]);

        DB::table('answers')->insert([
            'question_id' => 14,
            'round_id' => 6,
            'title' => 'Stole His Soul',
            'correct' => true,
        ]);

        DB::table('answers')->insert([
            'question_id' => 14,
            'round_id' => 6,
            'title' => 'Kidnap Him',
            'correct' => false,
        ]);

        DB::table('answers')->insert([
            'question_id' => 14,
            'round_id' => 6,
            'title' => 'Hospitalize Him',
            'correct' => false,
        ]);

        //question 2
        DB::table('questions')->insert([
            'round_id' => 6,
            'order_number' => 2,
            'title' => 'What does weevil throw into the ocean?',
            'type' => 'Multiple-Choice'
        ]);
//        answer

        DB::table('answers')->insert([
            'question_id' => 15,
            'round_id' => 6,
            'title' => 'The pieces of Exodia',
            'correct' => true,
        ]);

        DB::table('answers')->insert([
            'question_id' => 15,
            'round_id' => 6,
            'title' => "Yugi's invitational card",
            'correct' => false,
        ]);

        DB::table('answers')->insert([
            'question_id' => 15,
            'round_id' => 6,
            'title' => "The Blue Eyes of Yugi's grandfather",
            'correct' => false,
        ]);

        DB::table('answers')->insert([
            'question_id' => 15,
            'round_id' => 6,
            'title' => "Joey's Red Eyes",
            'correct' => false,
        ]);

        //question 3
        DB::table('questions')->insert([
            'round_id' => 6,
            'order_number' => 3,
            'title' => "How many stars are needed to enter pegasus's domain?",
            'type' => 'Multiple-Choice'
        ]);

        DB::table('answers')->insert([
            'question_id' => 16,
            'round_id' => 6,
            'title' => '5',
            'correct' => false,
        ]);

        DB::table('answers')->insert([
            'question_id' => 16,
            'round_id' => 6,
            'title' => '12',
            'correct' => false,
        ]);

        DB::table('answers')->insert([
            'question_id' => 16,
            'round_id' => 6,
            'title' => '7',
            'correct' => false,
        ]);

        DB::table('answers')->insert([
            'question_id' => 16,
            'round_id' => 6,
            'title' => '10',
            'correct' => true,
        ]);

        //round 2 question 1
        DB::table('questions')->insert([
            'round_id' => 7,
            'order_number' => 1,
            'title' => 'I gave Joey an entry fee card after his was stolen',
            'type' => 'Fill-in-blank'
        ]);

        DB::table('answers')->insert([
            'question_id' => 17,
            'round_id' => 7,
            'title' => 'Mai Valentine',
            'correct' => true,
        ]);

        //round 2 question 2
        DB::table('questions')->insert([
            'round_id' => 7,
            'order_number' => 2,
            'title' => 'I was the other character to have a millennium item',
            'type' => 'Fill-in-blank'
        ]);

        DB::table('answers')->insert([
            'question_id' => 18,
            'round_id' => 7,
            'title' => 'Bakura',
            'correct' => true,
        ]);


        //round 2 question 3
        DB::table('questions')->insert([
            'round_id' => 7,
            'order_number' => 3,
            'title' => 'I played "Sword of Revealing Light" and tried to kill Yugi when I lost',
            'type' => 'Fill-in-blank'
        ]);

        DB::table('answers')->insert([
            'question_id' => 19,
            'round_id' => 7,
            'title' => 'Panik',
            'correct' => true,
        ]);


        //round 3 question 1
        DB::table('questions')->insert([
            'round_id' => 8,
            'order_number' => 1,
            'title' => 'How Many Millennium items are there?',
            'type' => 'Multiple-Choice'
        ]);

        DB::table('answers')->insert([
            'question_id' => 20,
            'round_id' => 8,
            'title' => '5',
            'correct' => false,
        ]);

        DB::table('answers')->insert([
            'question_id' => 20,
            'round_id' => 8,
            'title' => '6',
            'correct' => false,
        ]);

        DB::table('answers')->insert([
            'question_id' => 20,
            'round_id' => 8,
            'title' => '7',
            'correct' => true,
        ]);

        DB::table('answers')->insert([
            'question_id' => 20,
            'round_id' => 8,
            'title' => '8',
            'correct' => false,
        ]);

        //round 3 question 2
        DB::table('questions')->insert([
            'round_id' => 8,
            'order_number' => 2,
            'title' => "What monster finished pegasus off?",
            'type' => 'Multiple-Choice'
        ]);

        DB::table('answers')->insert([
            'question_id' => 21,
            'round_id' => 8,
            'title' => 'Summoned skull',
            'correct' => false,
        ]);

        DB::table('answers')->insert([
            'question_id' => 21,
            'round_id' => 8,
            'title' => 'Black magician of chaos',
            'correct' => true,
        ]);

        DB::table('answers')->insert([
            'question_id' => 21,
            'round_id' => 8,
            'title' => 'Dark magician',
            'correct' => false,
        ]);

        DB::table('answers')->insert([
            'question_id' => 21,
            'round_id' => 8,
            'title' => 'Dark magician girl',
            'correct' => false,
        ]);


        //round 3 question 3
        DB::table('questions')->insert([
            'round_id' => 8,
            'order_number' => 3,
            'title' => "What is the name of Pegasus's wife?",
            'type' => 'Fill-in-blank'
        ]);

        DB::table('answers')->insert([
            'question_id' => 22,
            'round_id' => 8,
            'title' => 'Cecelia',
            'correct' => true,
        ]);

    }
}
