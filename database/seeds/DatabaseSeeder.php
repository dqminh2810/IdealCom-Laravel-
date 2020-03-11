<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$this->call(\Modules\Roles\Database\Seeders\PermissionsDatabaseSeeder::class);
		$this->call(\Modules\Roles\Database\Seeders\RolesDatabaseSeeder::class);
		$this->call(\Modules\Users\Database\Seeders\UsersDatabaseSeeder::class);
        $this->call(\Modules\Medias\Database\Seeders\PhotosDatabaseSeeder::class);
		$this->call(\Modules\News\Database\Seeders\NewsDatabaseSeeder::class);
		$this->call(\Modules\Cookies\Database\Seeders\CookiesDatabaseSeeder::class);
		$this->call(\Modules\Formulaires\Database\Seeders\FormulairesDatabaseSeeder::class);
		$this->call(\Modules\Countries\Database\Seeders\CountriesDatabaseSeeder::class);
        $this->call(\Modules\Agences\Database\Seeders\AgencesDatabaseSeeder::class);
		$this->call(\Modules\Domains\Database\Seeders\DomainsDatabaseSeeder::class);
		$this->call(\Modules\Menus\Database\Seeders\MenusDatabaseSeeder::class);
		$this->call(\Modules\Languages\Database\Seeders\LanguagesDatabaseSeeder::class);
		$this->call(\Modules\Subscribers\Database\Seeders\SubscribersDatabaseSeeder::class);
		$this->call(Modules\Profils\Database\Seeders\ProfilsDatabaseSeeder::class);
	}
}
