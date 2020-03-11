<?php

namespace Modules\Countries\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Modules\Countries\Entities\Country;

class CountriesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$countries = Config::get('countries.countries');

    	foreach ($countries as $key=>$country)
		{
			$pays = new Country();
			$pays->code = $country['numeric'];
			$pays->name = $country['name'];
			$pays->alpha2 = $country['alpha_2'];
			$pays->alpha3 = $country['alpha_3'];
			$pays->save();
		}
    }
}
