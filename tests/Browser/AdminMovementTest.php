<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminMovementTest extends DuskTestCase
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
                  ->type('username','admin')
                  ->type('password','admin')
                  ->press('Login')
                  ->pause(1000)
                  ->assertPathIs('/home')
                  ->clickLink('Messages')
                  ->assertPathIs('/inbox')
                  ->clickLink('My profile')
                  ->assertPathIs('/my_profile')
                  ->clickLink('Add new')
                  ->clickLink('Class')
                  ->pause(1000)
                  ->assertPathIs('/headmaster/add_class')
                  ->assertSee('Add new class')
                  ->clickLink('Display')
                  ->clickLink('Subjects')
                  ->pause(1000)
                  ->assertPathIs('/headmaster/subject_list')
                  ->assertSee('Subjects')
                  ->clickLink('Assign')
                  ->clickLink('Teacher')
                  ->select('teacher_id')
                  ->select('subject_id')
                  ->press('assign_teacher')
                  ->pause(1000)
                  ->assertPathIs('/headmaster/subject_list')
                  ->clickLink('View grades')
                  ->select('id')
                  ->press('view_grades')
                  ->assertPathIs('/headmaster/grades_view')
                  ->clickLink('Statistics')
                  ->clickLink('Teachers')
                  ->pause(1000)
                  ->assertPathIs('/headmaster/statistics_teachers')
                  ->clickLink('Log out')
                  ->pause(1000)
                  ->assertPathIs('/login');
      });
    }
}
