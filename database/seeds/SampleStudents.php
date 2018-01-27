<?php

use Illuminate\Database\Seeder;

class SampleStudents extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
        'username' => 'student1234',
        'password' => Hash::make('student1234'),
        'first_name' => str_random(10),
        'last_name' => str_random(10),
        'role_id' => 3
      ]);
      DB::table('users')->insert([
        'username' => 'student12345',
        'password' => Hash::make('student12345'),
        'first_name' => str_random(10),
        'last_name' => str_random(10),
        'role_id' => 3
      ]);
      DB::table('users')->insert([
        'username' => 'student123456',
        'password' => Hash::make('student123456'),
        'first_name' => str_random(10),
        'last_name' => str_random(10),
        'role_id' => 3
      ]);
    }
}
