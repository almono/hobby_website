<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TeacherMovementTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
      $this->browse(function (Browser $browser) {
          $browser->visit('/')
                  ->type('username','teacher')
                  ->type('password','teacher')
                  ->press('Login')
                  ->pause(1000)
                  ->assertPathIs('/home')
                  ->clickLink("Messages")
                  ->assertPathIs('/inbox')
                  ->clickLink("My subjects")
                  ->assertPathIs('/teacher/teacher_subject_class')
                  ->clickLink("History log")
                  ->assertPathIs("/teacher/teacher_history_log")
                  ->clickLink("Raports")
                  ->assertPathIs("/teacher/teacher_raports")
                  ->pause(1000)
                  ->press("new_raport")
                  ->pause(1000)
                  ->clickLink("Grade students")
                  ->select("id")
                  ->press("start_grading")
                  ->assertPathIs("/teacher/teacher_grades/form")
                  ->assertSee("Grade")
                  ->clickLink('Log out');
      });
    }
}
