<?php

namespace Modules\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use App\User;

class UsersDatabaseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// Création de 10 comptes superadmin, 10 comptes admin et 10 comptes normaux
		for($j = 0; $j < 3; $j++) {
			for($i = 0; $i < 10; $i++)
			{
				// Création de l'utilisateur
				$user = new User();
				$user->name = 'Nom_' . $j . $i;
				$user->email = 'email' . $j .$i . '@blop.fr';
				$user->password = bcrypt('password' . $j .$i);
				$user->telephone = '06000000'. $j . $i;
				$user->website = 'http://www.'.$user->name.'.fr';
				$user->address = $user->id.' rue Laravel';
				$user->city = 'Sophia-Antipolis';
				$user->country = 'France';

				$user->save();

				if ($j == 0) {
					$user->attachRole('superadmin');
				} elseif ($j == 1) {
					$user->attachRole('admin');
				}
			}
		}
	}
}
