<?php

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
        DB::table('users')->insert([
            'name' => 'Toti Cuervo',
            'email' => 'totifercuervo@gmail.com',
            'password' => bcrypt('22091927T'),
        ]);
    }
}
