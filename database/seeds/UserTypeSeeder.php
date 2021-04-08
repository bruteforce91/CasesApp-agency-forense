<?php

use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //creazione entry statiche in 'user type'
      //creazione utente
      DB::table('user_type')->insert([
         'id' => 1,
         'type' => 200,
         ]);

      //creazione utente:admin
      DB::table('user_type')->insert([
            'id' => 2,
            'type' => 100,
            ]);
    }
}
