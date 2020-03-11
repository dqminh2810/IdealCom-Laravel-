<?php

use Illuminate\Support\Facades\Auth;
Use \Tests\RouteTestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
/**
 * @test News Routes
 */

class NewsRouteTest extends RouteTestCase
{

    /**
     * @route news.index
     * @method GET
     */
    public function test_news_index()
    {
        $response = $this->call('GET', 'admin/news');
        $this->assertEquals(200, $response->status());
    }


    /**
     * @route news.create
     * @method GET
     */
    public function test_news_create()
    {
        $response = $this->call('GET', 'admin/news/3');
        $this->assertEquals(200, $response->status());
    }

    /**
     * @route news.enable
     * @method PUT
     */
    public function test_users_enable(){
        $response = $this->call('PUT', 'admin/news/3/enable');
        $this->assertEquals(200, $response->status());
    }

    /**
     * @route news.disable
     * @method PUT
     */
    public function test_users_disable(){
        $response = $this->call('PUT', 'admin/news/3/disable');
        $this->assertEquals(200, $response->status());
    }

    /**
     * @route news.show
     * @method GET
     */
    public function test_news_show(){
        $response = $this->call('GET', 'admin/news/create');
        $this->assertEquals(200, $response->status());
    }

    /**
     * @route news.store
     * @method POST
     */
    public function test_news_store()
    {
        $data = [
            'title'=>'TestTitle',
            'content'=>'This is test content'
        ];
        $response = $this->call('POST', 'admin/news', $data);
        $this->seeInDatabase('news', ['title'=>'TestTitle']);
    }

    /**
     * @route news.edit
     * @method GET
     */
    public function test_news_edit()
    {
        $response = $this->call('GET', 'admin/news/3/edit');
        $this->assertEquals(200, $response->status());
    }

    /**
     * @route news.update
     * @method PUT
     */
    public function test_news_update()
    {
        $data = [
            'title'=>'TestTitle',
            'content'=>'This is test content'
        ];
        $response = $this->call('PUT', 'admin/news/3', $data);
        $this->seeInDatabase('news', ['title'=>'TestTitle']);
    }


    /**
     * @route news.destroy
     * @method DELETE
     */
    public function test_news_destroy()
    {
        $response = $this->call('DELETE', 'admin/news/3');
        $this->dontSeeInDatabase('news', ['title'=>'Titre2']);
    }


}
