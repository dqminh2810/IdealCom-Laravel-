<?php

use \Tests\RouteTestCase;

/**
 * @test Auth Routes
 */
class AuthRouteTest extends RouteTestCase
{
    use \Tests\CreatesApplicationWithoutAuth;
    /**
     * @route admin.login
     * @method GET
     */
    public function test_login_form_route()
    {
        $response = $this->call('GET', 'admin/login');
        $this->assertEquals(200, $response->status());
    }

    /**
     * @route admin.login.check
     * @method POST
     */

    public function test_login_route()
    {
        $data = [
            'email_login'=>'email00@blop.fr',
            'password'=>'password00'
        ];
        $response = $this->call('POST', 'admin/login', $data);
        $this->assertEquals(302, $response->status());
    }

    /**
     * @route logout
     * @method POST
     */
    public function test_logout_route(){
        $response = $this->call('POST', 'logout');
        $this->assertEquals(302, $response->status());
    }
}
