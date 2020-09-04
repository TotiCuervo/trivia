<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
        $this->call(GameTableSeeder::class);
        $this->call(GKGame1TableSeeder::class);
//        $this->call(YugiohSeason1Seeder::class);
        $this->call(DisneyTrivia1Seeder::class);

    }
}
