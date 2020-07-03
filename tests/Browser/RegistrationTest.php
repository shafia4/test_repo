<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegistrationTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testRegister()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->assertSee('Register', 'div');
            $browser->type('name', 'John Doe');
            $browser->type('email', 'otan@getnada.com');
            $browser->type('password', 'testing!');
            $browser->type('password_confirmation', 'testing!');
            $browser->press('Register');
            // make sure we see right page after registration succeeded
            $browser->waitForText('Welcome to White');
            // make sure we see John, which is user first name that expected to have
            $browser->waitForText('John');
        });
    }
}
