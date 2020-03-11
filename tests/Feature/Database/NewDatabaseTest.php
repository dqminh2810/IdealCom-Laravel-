<?php
/**
 * Created by PhpStorm.
 * User: dqminh
 * Date: 11/05/2018
 * Time: 14:01
 */

Use \Illuminate\Support\Facades\DB;
Use \Tests\TestCase;
use \Tests\SetUpDatabase;

/**
 * @test Database news
 *
 */
class New_Test extends TestCase
{
    use SetUpDatabase;

    /**
     * @test Insert a new
     *
     */
    public function test_news_table_insert(){
        $title='test';
        $content='test123456789';
        $user_id=8;
        DB::table('news')->insert([
            'title'=>$title,
            'content'=>$content,
            'user_id'=>$user_id
        ]);
        $this->assertDatabaseHas('news', ['title' => $title]);
    }

    /**
     * @test Update a new
     *
     */
    public function test_news_table_update(){
        $title='Titre0';
        $content = 'Test Content';
        DB::table('news')->where('title', $title)->update(['content'=>$content]);
        $this->assertDatabaseHas('news', ['content' => $content]);
    }

    /**
     * @test Delete a new
     *
     */
    public function test_news_table_delete(){
        DB::table('news')->delete(1);
        $this->assertDatabaseMissing('news',['title' => 'Titre0']);
    }
}
