<?php

use Illuminate\Database\Seeder;

class GradesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('grades')->insert([
        'user_id' => 4,
        'class_id' => 1,
        'subject_id' => 1,
        'grade' => 3,
        'teacher_id' => 2,
        'comment' => 'Exam on 21.03.2016'
      ]);
      DB::table('grades')->insert([
        'user_id' => 5,
        'class_id' => 2,
        'subject_id' => 1,
        'grade' => 5,
        'teacher_id' => 2,
        'comment' => 'Short test'
      ]);
      DB::table('grades')->insert([
        'user_id' => 4,
        'class_id' => 1,
        'subject_id' => 2,
        'grade' => 3,
        'teacher_id' => 2
      ]);
    }
}
