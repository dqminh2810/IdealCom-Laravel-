<?php

namespace Modules\Roles\Database\Seeders;

use App\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

class PermissionsDatabaseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// Modules\Roles\Config\config.php
		$permissions = Config::get('roles.permissions');

		foreach ($permissions as $name => $details) {

			// Création de la permission
			$permission = new Permission();
			$permission->name = $name;
			foreach ($details as $key=>$value) {
				$permission->$key = $value;
			}

			$permission->save();
		}
	}
}
