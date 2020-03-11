<?php

namespace Modules\Countries\Facades;

use Modules\Countries\Entities\Country;

class CountriesFacade
{
	public static function getArrayCountry()
	{
		$countries = Country::all();
		$result = array();
		foreach ($countries as $key=>$country)
		{
			$result[$country->id] = $country->name;
		}

		return $result;
	}
}