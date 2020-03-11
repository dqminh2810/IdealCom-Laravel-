<?php

Use \Tests\RouteTestCase;

/**
 * @test Users Routes
 */
class UsersRouteTest extends RouteTestCase
{
    /**
     * @route users.index
     * @method GET
     */
    public function test_users_index()
    {
        $response = $this->call('GET', 'admin/users');
        $this->assertEquals(200, $response->status());
    }


    /**
     * @route users.create
     * @method GET
     */
    public function test_users_create()
    {
        $response = $this->call('GET', 'admin/users/create');
        $this->assertEquals(200, $response->status());
    }

    /**
     * @route users.enable
     * @method PUT
     */
    public function test_users_enable(){
        $response = $this->call('PUT', 'admin/users/3/enable');
        $this->assertEquals(200, $response->status());
    }

    /**
     * @route users.disable
     * @method PUT
     */
    public function test_users_disable(){
        $response = $this->call('PUT', 'admin/users/3/disable');
        $this->assertEquals(200, $response->status());
    }

    /**
     * @route users.store
     * @method POST
     */
    public function test_users_store()
    {
        $data = [
            'email'=>'testname@gmail.com',
            'name'=>'testname',
            'password'=>bcrypt('123456')
        ];
        $response = $this->call('POST', 'admin/users', $data);
        $this->seeInDatabase('users', ['name'=>'testname']);
    }

    /**
     * @route users.edit
     * @method GET
     */
    public function test_users_edit()
    {
        $response = $this->call('GET', 'admin/users/3/edit');
        $this->assertEquals(200, $response->status());
    }


    /**
     * @route users.update
     * @method PUT
     */
    public function test_users_update()
    {
        $data = [
            'email'=>'testnameUpdated@gmail.com',
            'name'=>'testnameUpdated',
            'password'=>bcrypt('123456')
        ];
        $response = $this->call('PUT', 'admin/users/3', $data);
        $this->seeInDatabase('users', ['name'=>'testnameUpdated']);
    }


    /**
     * @route users.destroy
     * @method DELETE
     */
    public function test_users_destroy()
    {
        $response = $this->call('DELETE', 'admin/users/3');
        $this->dontSeeInDatabase('users', ['name'=>'Nom_02']);
    }
}
