<?php

use Illuminate\Database\Seeder;

class EmailNotifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('emailnotifications')->insert([
          'user_id' => 4,
          'status' => 1,
        ]);
    }
}
