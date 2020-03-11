<?php

namespace Tests;


use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Dusk\Concerns\InteractsWithMouse;
use Laravel\Dusk\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Laravel\Dusk\Browser;

abstract class DuskTestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Prepare for Dusk test execution.
     *
     * @beforeClass
     * @return void
     */
    public static function prepare()
    {
        static::startChromeDriver();

    }

    /**
     * Create the RemoteWebDriver instance.
     *
     * @return \Facebook\WebDriver\Remote\RemoteWebDriver
     */
    protected function driver()
    {
        $options = (new ChromeOptions)->addArguments([
            '--disable-gpu',
            '--headless'
        ]);

        return RemoteWebDriver::create(
            'http://localhost:9515', DesiredCapabilities::chrome()->setCapability(
                ChromeOptions::CAPABILITY, $options
            )
        );
    }

    /**
     * @return  login Index URL
     *
     */
    public function getUrlLoginIndex(){
        return env('APP_URL').'/admin/login';
    }

    /**
     * @return  admin dashboard URL
     *
     */
    public function getUrlAdminDashboard(){
        return env('APP_URL').'/admin/dashboard';
    }


    /**
     * @return  new Index URL
     *
     */
    public function getUrlNewsIndex(){
        return env('APP_URL').'/admin/news';
    }

    /**
     * @return  new Preview URL
     *
     */
    public function getUrlNewsPreview($id){
        return env('APP_URL').'/admin/news/'.$id;
    }

    /**
     * @return  new Create URL
     *
     */
    public function getUrlNewsCreate(){
        return env('APP_URL').'/admin/news/create';
    }

    /**
     * @return  new Edit URL
     *
     */
    public function getUrlNewsEdit($id){
        return env('APP_URL').'/admin/news/'.$id.'/edit';
    }

    /**
     * @return  user Index URL
     *
     */
    public function getUrlUsersIndex(){
        return env('APP_URL').'/admin/users';
    }

    /**
     * @return  user Create URL
     *
     */
    public function getUrlUsersCreate(){
        return env('APP_URL').'/admin/users/create';
    }

    /**
     * @return  user Edit URL
     *
     */
    public function getUrlUsersEdit($id){
        return env('APP_URL').'/admin/users/'.$id.'/edit';
    }

    /**
     * @return  formulaire index URL
     *
     */
    public function getUrlFormulairesIndex(){
        return env('APP_URL').'/admin/formulaires';
    }

    /**
     * @return  field's id formulaires index URL
     *
     */
    public function getUrlFieldsIndex($id){
        return env('APP_URL').'/admin/fields/'.$id;
    }

}
