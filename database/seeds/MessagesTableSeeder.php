<?php

use Illuminate\Database\Seeder;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('messages')->insert([
        'from' => 1,
        'to' => 2,
        'topic' => 'Test',
        'content' => 'Hello there test',
        'status' => 0
      ]);
      DB::table('messages')->insert([
        'from' => 2,
        'to' => 1,
        'topic' => 'Test',
        'content' => 'Hello there test',
        'status' => 1
      ]);
      DB::table('messages')->insert([
        'from' => 1,
        'to' => 2,
        'topic' => 'Test123',
        'content' => 'Hello there please burn',
        'status' => 1
      ]);
      DB::table('messages')->insert([
        'from' => 1,
        'to' => 3,
        'topic' => 'Test',
        'content' => 'Hello there test',
        'status' => 0
      ]);
      DB::table('messages')->insert([
        'from' => 1,
        'to' => 4,
        'topic' => 'Test',
        'content' => 'Hello there test',
        'status' => 0
      ]);
    }
}
