<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
          'username' => 'admin',
          'password' => Hash::make('admin'),
          'first_name' => str_random(10),
          'last_name' => str_random(10),
          'role_id' => 1
        ]);
        DB::table('users')->insert([
          'username' => 'teacher',
          'password' => Hash::make('teacher'),
          'first_name' => str_random(10),
          'last_name' => str_random(10),
          'role_id' => 2
        ]);
        DB::table('users')->insert([
          'username' => 'teacher2',
          'password' => Hash::make('teacher2'),
          'first_name' => str_random(10),
          'last_name' => str_random(10),
          'role_id' => 2
        ]);
        DB::table('users')->insert([
          'username' => 'student',
          'password' => Hash::make('student'),
          'first_name' => str_random(10),
          'last_name' => str_random(10),
          'role_id' => 3,
          'class_id' => 1,
          'email' => "student_mail@gmail.com"
        ]);
        DB::table('users')->insert([
          'username' => 'student2',
          'password' => Hash::make('student2'),
          'first_name' => str_random(10),
          'last_name' => str_random(10),
          'role_id' => 3,
          'class_id' => 2
        ]);
        DB::table('users')->insert([
          'username' => 'student3',
          'password' => Hash::make('student3'),
          'first_name' => str_random(10),
          'last_name' => str_random(10),
          'role_id' => 3,
          'class_id' => 3
        ]);
    }
}
