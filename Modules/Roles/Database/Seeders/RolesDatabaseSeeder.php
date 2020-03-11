<?php

namespace Modules\Roles\Database\Seeders;

use App\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

class RolesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// Modules\Roles\Config\config.php
		$roles = Config::get('roles.roles');

		foreach ($roles as $name => $details) {

			// Création du rôle
			$role = new Role();
			$role->name = $name;
			foreach ($details as $key => $value) {
				if ($key != 'permissions') {
					$role->$key = $value;
				}
			}

			// Il faut sauvegarder le rôle dans la bdd avant de lui assigner des permissions
			$role->save();

			// Assignation des permissions au rôle
			foreach ($details as $key=>$value) {
				if ($key == 'permissions') {
					$role->attachPermissions($value);
				}
			}

		}
    }
}
