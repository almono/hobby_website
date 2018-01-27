<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Role;
use App\ClassMain;
use App\User;
use App\Subjects;
use App\Message;

class CreateAndEditRecordsTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $role = factory(\App\Role::class)->create(['name' => 'Headmaster', 'slug' => 'headmaster']);
        $this -> assertDatabaseHas('roles',['name' => 'Headmaster']);
        $role = factory(\App\Role::class)->create(['name' => 'Teacher', 'slug' => 'teacher']);
        $this -> assertDatabaseHas('roles',['name' => 'Teacher']);
        $role = factory(\App\Role::class)->create(['name' => 'Student', 'slug' => 'student']);
        $this -> assertDatabaseHas('roles',['name' => 'Student']);
        $role = Role::where('name','=','Student')->take(1)->update(['name' => 'Peasant']);
        $this -> assertDatabaseHas('roles',['name' => 'Peasant']);

        $class = factory(\App\ClassMain::class)->create(['name' => 'B']);
        $class = factory(\App\ClassMain::class,20)->create();
        $this -> assertDatabaseHas('class',['name' => 'B']);
        $class = ClassMain::inRandomOrder()->take(1)->update(['name' => 'XYZ']);
        $this -> assertDatabaseHas('class',['name' => 'XYZ']);

        $user = factory(\App\User::class)->create(['username' => 'admin', 'password' => 'admin','role_id' => 1]);
        $user = factory(\App\User::class,20)->create();
        $this -> assertDatabaseHas('users',['username' => 'admin']);
        $user = User::inRandomOrder()->take(1)->update(['last_name' => 'Buttscratcher']);
        $this -> assertDatabaseHas('users',['last_name' => 'Buttscratcher']);

        $subject = factory(\App\Subjects::class,10)->create();
        $subject = factory(\App\Subjects::class)->create(['name' => 'Math']);
        $this -> assertDatabaseHas('subjects',['name' => 'Math']);
        $subject = Subjects::inRandomOrder()->take(1)->update(['name' => 'Assassination']);
        $this -> assertDatabaseHas('subjects',['name' => 'Assassination']);

        $message = factory(\App\Message::class)->create();
        $message = Message::inRandomOrder()->take(1)->update(['topic' => 'New' , 'content' => 'Message']);
        $this -> assertDatabaseHas('messages',['topic' => 'New', 'content' => 'Message']);

    }
}
