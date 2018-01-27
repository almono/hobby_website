<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class StudentProfileTest extends DuskTestCase
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
                  ->assertPathIs('/home')
                  ->pause(1000)
                  ->visit('/my_profile')
                  ->assertPathIs('/my_profile')
                  ->pause(1000)
                  ->type('new_password','student123')
                  ->press('change_password')
                  ->clickLink('Log out');
        });
    }
}
