<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('roles')->insert([
        'name' => 'Headmaster',
        'slug' => str_slug('Headmaster','-')
      ]);
      DB::table('roles')->insert([
        'name' => 'Teacher',
        'slug' => str_slug('Teacher','-')
      ]);
      DB::table('roles')->insert([
        'name' => 'Student',
        'slug' => str_slug('Student','-')
      ]);
    }
}
