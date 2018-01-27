<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class StudentMovementTest extends DuskTestCase
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
                  ->type('username','student')
                  ->type('password','student')
                  ->press('Login')
                  ->pause(1000)
                  ->assertPathIs('/home')
                  ->clickLink('Messages')
                  ->assertPathIs('/inbox')
                  ->clickLink('My grades')
                  ->assertPathIs('/student/student_grades')
                  ->clickLink('Notifications')
                  ->pause(1000)
                  ->assertPathIs('/student/student_mail')
                  ->type('email','alfredo_best_student@gmail.com')
                  ->pause(1000)
                  ->press('enable_notif')
                  ->pause(1000)
                  ->assertRouteIs('student_mail')
                  ->assertSee('You have enabled the notifications!')
                  ->clickLink('Log out')
                  ->pause(1000)
                  ->assertPathIs('/login');
      });
    }
}
