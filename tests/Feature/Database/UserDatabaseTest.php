<?php
/**
 * Created by PhpStorm.
 * User: dqminh
 * Date: 11/05/2018
 * Time: 13:16
 */

Use \Tests\TestCase;
Use \Illuminate\Support\Facades\DB;
/**
 * @test Database users
 *
 */
class UserDatabaseTest extends TestCase
{
    /**
     * @test Insert a user
     *
     */
    public function test_user_table_insert(){
        $name='test';
        $email='test@gmail.com';
        $password=bcrypt('testpassword');
        DB::table('users')->insert([
                                        'name' => $name,
                                        'email' => $email,
                                        'password' => $password
                                        ]);
        $this->assertDatabaseHas('users', ['name' => $name, 'email' => $email, 'password' => $password ]);
    }

    /**
     * @test Update a user
     *
     */
    public function test_user_table_update(){
        $this->assertDatabaseHas('users', ['name'=>'Nom_00']);
        $name="Nom_00";
        $email='gogo@gmail.com';
        DB::table('users')->where('name', $name)->update(['email'=>$email]);
        $this->assertDatabaseHas('users', ['email' => $email]);
    }

    /**
     * @test Delete a user
     *
     */
    public function test_user_table_delete(){
        DB::table('users')->delete(1);

        $this->assertDatabaseMissing('users',['name' => 'Nom_00']);
    }

}
