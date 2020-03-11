<?php
/**
 * Created by PhpStorm.
 * User: dqminh
 * Date: 11/05/2018
 * Time: 14:31
 */
Use \Illuminate\Support\Facades\DB;
use Tests\SetUpDatabase;
Use \Tests\TestCase;

/**
 * @test Database roles
 *
 */
class RoleDatabaseTest extends TestCase
{
    use SetUpDatabase;
    /**
     * @test Check if exist admin and superadmin roles
     *
     */
    public function test_check_Roles_exsist(){
        $this->assertDatabaseHas('roles',['name' => 'admin']);
        $this->assertDatabaseHas('roles',['name' => 'superadmin']);
    }
}
