<?php

use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('subjects')->insert([
        'name' => 'Math',
        'leading_teacher' => 2
      ]);
      DB::table('subjects')->insert([
        'name' => 'IT',
        'leading_teacher' => 2
      ]);
      DB::table('subjects')->insert([
        'name' => 'PE',
        'leading_teacher' => 2
      ]);
      DB::table('subjects')->insert([
        'name' => 'History',
        'leading_teacher' => 3
      ]);
    }
}
