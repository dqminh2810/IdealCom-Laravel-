<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\SetUpDatabase;

/**
 * @test login page's functionals
 *
 */
class BrowserLoginPageTest extends DuskTestCase
{
    /**
     * @test test login functional
     * @case1: type wrong password and wrong email
     * @case2: type right password and right email
     */
    public function test_browser_login(){
        $this->browse(function (Browser $browser) {
            $browser->resize(1920, 1080);
            $browser->visit('/admin/login')
                    ->assertSee('Se connecter au Back-Office')
                    ->type('email', 'email00@blop.fr')
                    ->type('password', 'password00')
                    ->clickButtonWithId('login')
                    ->assertSee('Dashboard');
        });

    }
    /**
     * @test test logout functional
     * @case: click "Déconnexion" button
     */
    public function test_browser_logout(){
        $this->browse(function (Browser $browser) {
            $browser->clickLink('Déconnexion')
                ->pause(3000)
                ->assertUrlIs($this->getUrlLoginIndex())
                ->assertSee('Se connecter au Back-Office');
        });
    }



    /**
     * Reset session
     *
     */
    public function tearDown()
    {
        session()->flush();
        parent::tearDown(); // TODO: Change the autogenerated stub

    }
}
