<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateRecordsTest extends TestCase
{
	use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */

    public function testCreateRecords()
    {
        $role = factory(\App\Role::class)->create(['name' => 'Headmaster', 'slug' => 'headmaster']);
		$this -> assertDatabaseHas('roles',['name' => 'Headmaster']);
        $role = factory(\App\Role::class)->create(['name' => 'Teacher', 'slug' => 'teacher']);
		$this -> assertDatabaseHas('roles',['name' => 'Teacher']);
        $role = factory(\App\Role::class)->create(['name' => 'Student', 'slug' => 'student']);
		$this -> assertDatabaseHas('roles',['name' => 'Student']);

		$class = factory(\App\ClassMain::class)->create(['name' => 'A']);
		$class = factory(\App\ClassMain::class)->create(['name' => 'B']);
		$class = factory(\App\ClassMain::class,10)->create();
		$this -> assertDatabaseHas('class',['name' => 'A']);
		$this -> assertDatabaseMissing('class',['name' => 'Test']);
		$this -> assertDatabaseHas('class',['name' => 'B']);

		$user = factory(\App\User::class)->create(['username' => 'admin', 'password' => 'admin','role_id' => 1]);
		$user = factory(\App\User::class,20)->create();
		$this -> assertDatabaseHas('users',['username' => 'admin']);

		$subject = factory(\App\Subjects::class,5)->create();
		$subject = factory(\App\Subjects::class)->create(['name' => 'Math']);
		$this -> assertDatabaseHas('subjects',['name' => 'Math']);

		$message = factory(\App\Message::class)->create();
    }
}
