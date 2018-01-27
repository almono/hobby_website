<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class FakeMessageTest extends DuskTestCase
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
                    ->assertPathIs('/home')
                    ->pause(1000)
                    ->visit("/inbox")
                    ->assertPathIs('/inbox')
                    ->press("new")
                    ->pause(1000)
                    ->assertPathIs("/inbox/new")
                    ->select('person')
                    ->type('topic','Dusk test')
                    ->type('content','This is a dusk test')
                    ->press("send")
                    ->pause(1000)
                    ->assertSee("Your message has been sent!")
                    ->clickLink('Log out');
        });
    }
}
