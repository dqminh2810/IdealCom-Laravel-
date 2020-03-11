<?php

namespace Tests\Browser;

use Illuminate\Support\Facades\Artisan;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

/**
 * @test news page's functionals
 *
 */

class BrowserNewsPageTest extends DuskTestCase
{

    /**
     * @test new preview functional
     * @case: click "Prévisualiser" button
     */
    public function test_browser_preview_new(){
        $this->browse(function (Browser $browser) {
            $browser->resize(1920, 2000);
            $browser->visit('/admin/login')
                ->type('email', 'email00@blop.fr')
                ->type('password', 'password00')
                ->clickButtonWithId("login")
                ->assertSee('Dashboard')
                ->visit('/admin/news')
                ->assertSee('Gestion des actualités')
                ->clickLinkWithId('preview_news_2')
                ->assertUrlIs($this->getUrlNewsPreview(2))
                ->assertSee('Prévisualisation: Titre1');
        });
    }



    /**
     * @test new create functional
     * @case1: Empty Title and Content fields
     * @case2: Type title field less than 5 letters
     * @case3: Type right title and content fields
     */
    public function test_browser_create_new()
    {
        $this->browse(function (Browser $browser) {
            $browser->resize(1920, 1080);
            $browser->visit('/admin/news')
                ->assertSee('Gestion des actualités')
                ->clickLinkWithId('creer_news')
                ->assertUrlIs($this->getUrlNewsCreate())
                ->assertSee('Créer une nouvelle actualité')
                /*Case 1*/
                ->type('title', '')
                ->type('content', '')
                ->clickInputWithId('creer')
                //->assertSee('The title field is required.')
                //->assertSee('The content field is required.')
                ->assertUrlIs($this->getUrlNewsCreate())
                /*Case 2*/
                ->type('title', 'test')
                ->type('content', 'This is a edit new test with Laravel Dusk')
                ->clickInputWithId('creer')
                ->assertSee('The title must be at least 5 characters.')
                ->assertUrlIs($this->getUrlNewsCreate())
                /*Case 3*/
                ->type('title', 'testTitle')
                ->type('content', 'This is a edit new test with Laravel Dusk')
                ->clickInputWithId('creer')
                ->assertUrlIs($this->getUrlNewsIndex())
                ->pause(3000)
                ->assertSee('Successfully created news!');
        });
    }

    /**
     * @test new disable functional
     *
     */
    public function test_browser_disable_user(){
        $this->browse(function (Browser $browser) {
            $browser->resize(1920, 1080)
                ->assertUrlIs($this->getUrlNewsIndex())
                ->clickSpanWithId(4)
                ->pause(3000)
                ->assertSee('Inactif');
        });
    }

    /**
     * @test new enable functional
     *
     */
    public function test_browser_enable_user(){
        $this->browse(function (Browser $browser) {
            $browser->resize(1920, 1080)
                ->assertUrlIs($this->getUrlNewsIndex())
                ->clickSpanWithId(4)
                ->pause(3000)
                ->assertSee('Actif');
        });
    }


    /**
     * @test delete new functional
     * @case: Empty Title and Content fields
     */
    public function test_browser_delete_new()
    {
        $this->browse(function (Browser $browser) {
            $browser->resize(1920, 1080);
            $browser->assertSee('Gestion des actualités')
                ->clickButtonWithId('2')
                ->pause(3000)
                ->assertUrlIs($this->getUrlNewsIndex())
                ->assertDontSee('testTitle');
        });
    }

    /**
     * @test new edit functional
     * @case1: Empty Title and Content fields
     * @case2: Type title field less than 5 letters
     * @case3: Type right title and content fields
     */
    public function test_browser_edit_new()
    {
        $this->browse(function (Browser $browser) {
            $browser->resize(1920, 1080);
            $browser->visit('/admin/news')
                ->assertSee('Gestion des actualités')
                ->clickLinkWithId('edit_news_2')
                ->assertUrlIs($this->getUrlNewsEdit(2))
                ->assertSee('Editer l\'actualité :')
                /*Case 1*/
                ->type('title', '')
                ->type('content', '')
                ->clickInputWithId('editer')
                //->assertSee('The title field is required.')
                //->assertSee('The content field is required.')
                /*Case 2*/
                ->type('title', 'test')
                ->type('content', 'This is a edit new test with Laravel Dusk')
                ->clickInputWithId('editer')
                ->assertSee('The title must be at least 5 characters.')
                /*Case 3*/
                ->type('title', 'testTitle')
                ->type('content', 'This is a edit new test with Laravel Dusk')
                ->clickInputWithId('editer')
                ->assertUrlIs($this->getUrlNewsIndex())
                ->assertSee('Successfully updated News!');
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
        parent::tearDown();  //TODO: Change the autogenerated stub

    }
}
