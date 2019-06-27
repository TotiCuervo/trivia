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
    }
}
