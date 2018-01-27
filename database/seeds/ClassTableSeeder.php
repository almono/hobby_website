<?php

use Illuminate\Database\Seeder;

class ClassTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('class')->insert([
        'name' => 'A'
      ]);
      DB::table('class')->insert([
        'name' => 'B'
      ]);
      DB::table('class')->insert([
        'name' => 'C'
      ]);
    }
}
