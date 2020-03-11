<?php

namespace Modules\Domains\Facades;

use Modules\Domains\Entities\Domain;

class DomainsFacade
{
	public static function getArrayDomains()
	{
		$domains = Domain::all();
		$result = array();
		foreach ($domains as $key=>$domain)
		{
			$result[$domain->id] = $domain->name;
		}

		return $result;
	}
}