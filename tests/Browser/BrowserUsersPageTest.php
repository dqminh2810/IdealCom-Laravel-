<?php

namespace Tests\Browser;

use Illuminate\Support\Facades\Artisan;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\SetUpDatabase;

/**
 * @test users page's functionals
 *
 */

class BrowserUsersPageTest extends DuskTestCase
{

    /**
     * @test user create functional
     * @case1: Empty Name, Email and Password fields
     * @case2: Type Name field less than 5 letters
     * @case3: Type right Name, Email and Password fields
     */
    public function test_browser_create_user()
    {
        $this->browse(function (Browser $browser) {
            $browser->resize(1920, 2000);
            $browser->visit('/admin/login')
                    ->type('email', 'email00@blop.fr')
                    ->type('password', 'password00')
                    ->clickButtonWithId("login")
                    ->assertSee('Dashboard')
                ->visit('/admin/users')
                    ->assertSee('Gestion des utilisateurs')
                    ->clickLinkWithId("creer_utilisateur")
                    ->assertUrlIs($this->getUrlUsersCreate())
                    ->assertSee('Créer un nouveau utilisateur')
                /*Case 1*/
                    ->type('email', '')
                    ->type('name', '')
                    ->type('password', '')
                    ->clickInputWithId("creer")
                    //->assertSee('The name field is required.')
                    //->assertSee('The email must be a valid email address.')
                    //->assertSee('The email field is required.')
                    //->assertSee('The password field is required.')
                    ->assertUrlIs($this->getUrlUsersCreate())

                /*Case 2*/
                    ->type('email', 'test@gmail.com')
                    ->type('name', 'test')
                    ->type('password', 'passwordtest')
                    ->clickInputWithId("creer")
                    ->assertSee('The name must be at least 5 characters.')
                /*Case 3*/
                    ->type('email', 'test@gmail.com')
                    ->type('name', 'testname')
                    ->type('password', 'passwordtest')
                    ->clickInputWithId("creer")
                    ->assertUrlIs($this->getUrlUsersIndex())
                    ->assertSee('Vous avez bien créé un nouveau utilisateur !');
        });
    }

    /**
     * @test user disable functional
     *
     */
    public function test_browser_disable_user(){
        $this->browse(function (Browser $browser) {
            $browser->resize(1920, 1080)
                //->assertUrlIs($this->getUrlUsersIndex())
                ->clickSpanWithId(4)
                ->pause(3000)
                ->assertSee('Inactif');
        });
    }

    /**
     * @test user enable functional
     *
     */
    public function test_browser_enable_user(){
        $this->browse(function (Browser $browser) {
            $browser->resize(1920, 1080)
                ->assertUrlIs($this->getUrlUsersIndex())
                ->clickSpanWithId(4)
                ->pause(3000)
                ->assertSee('Actif');
        });
    }

    /**
     * @test user delete functional
     * @case: Empty Title and Content fields
     */
    public function test_browser_delete_user()
    {
        $this->browse(function (Browser $browser) {
            $browser->resize(1920, 1080);
            $browser->assertSee('Gestion des utilisateurs')
                ->clickButtonWithId(4)
                ->pause(3000)
                ->assertUrlIs($this->getUrlUsersIndex())
                ->assertDontSee('Nom_03');
        });
    }

    /**
     * @test user edit functional
     * @case1: Empty Name and Email fields
     * @case2: Type Name field less than 5 letters
     * @case3: Type right Name, Email and Password fields
     */
    public function test_browser_edit_user()
    {
        $this->browse(function (Browser $browser) {
            $browser->resize(1920, 2000);
            $browser->assertSee('Gestion des utilisateurs')
                ->clickLinkWithId("edit_user_2")
                ->assertUrlIs($this->getUrlUsersEdit(2))
                ->assertSee('Editer l\'utilisateur : Nom_01')
                /*Case 1*/
                ->type('email', '')
                ->type('name', '')
                ->clickInputWithId("editer")
                //->assertSee('The name field is required.')
                //->assertSee('The email must be a valid email address.')
                //->assertSee('The email field is required.')
                /*Case 2*/
                ->type('email', 'test@gmail.com')
                ->type('name', 'test')
                ->type('password', 'passwordtest')
                ->clickInputWithId("editer")
                ->assertSee('The name must be at least 5 characters.')
                /*Case 3*/
                ->type('email', 'test@gmail.com')
                ->type('name', 'testbrowser')
                ->type('password', 'passwordtest')
                ->clickInputWithId("editer")
                ->assertUrlIs($this->getUrlUsersIndex())
                ->assertSee('L\'utilisateur a bien été modifié !');
        });
    }


    /**
     * Reset database and session
     *
     */
    public function tearDown()
    {
        session()->flush();
        Artisan::call('migrate:refresh');
        Artisan::call('db:seed');
        parent::tearDown(); // TODO: Change the autogenerated stub

    }

}
