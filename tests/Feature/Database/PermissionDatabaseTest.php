<?php
Use \Illuminate\Support\Facades\DB;
use Tests\SetUpDatabase;
Use \Tests\TestCase;
Use \Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @test Database permissions
 *
 */
class PermissionDatabaseTest extends TestCase
{
    use SetUpDatabase;
    /**
     * @test Insert a permission
     *
     */
    public function test_permissions_table_insert(){
        $name='admin-test';
        $display_name='Admin des tests';
        $description='This is for test';
        DB::table('permissions')->insert([
                                            'name'=>$name,
                                            'display_name'=>$display_name,
                                            'description'=>$description
                                            ]);
        $this->assertDatabaseHas('permissions', ['name' => 'admin-test']);
    }

    /**
     * @test Update a permission
     *
     */
    public function test_permissions_table_update(){
        $name='admin-news';
        $description='Test Description';
        DB::table('permissions')->where('name',$name)->update(['description'=>$description]);
        $this->assertDatabaseHas('permissions', ['description' => $description]);
    }

    /**
     * @test Delete a permission
     *
     */
    public function test_permissions_table_delete(){
        DB::table('permissions')->delete(1);
        $this->assertDatabaseMissing('permissions',['name' => 'admin-dashboard']);
    }
}
