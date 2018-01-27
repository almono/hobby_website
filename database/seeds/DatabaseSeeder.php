<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(ClassTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(SubjectsTableSeeder::class);
        $this->call(ClassSubjectTableSeeder::class);
        $this->call(MessagesTableSeeder::class);
        $this->call(GradesTableSeeder::class);
        $this->call(EmailNotifSeeder::class);
    }
}
