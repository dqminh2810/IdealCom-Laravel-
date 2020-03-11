<?php

namespace Modules\Domains\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Countries\Entities\Country;
use Modules\Domains\Entities\Domain;

class DomainsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $domain = new Domain();
        $domain->code = "localhost";
        $domain->name = "localhost";
        $domain->display_name = "Dev Local";
        $domain->extension = "null";
		$domain->country_id = Country::find(1)->id;
		$domain->save();
    }
}
