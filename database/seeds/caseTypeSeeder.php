<?php

use Illuminate\Database\Seeder;

class caseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('cases_type')->insert([
         'id' => 1,
         'tipologia' => "IMAGE",
         'script' => "resources\js\alert.js",
         'view' => "resources\views\case_create.blade.php",
         ]);
         
    }
}
