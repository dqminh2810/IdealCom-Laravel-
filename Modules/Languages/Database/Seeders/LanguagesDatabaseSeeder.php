<?php

namespace Modules\Languages\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Modules\Languages\Entities\Language;

class LanguagesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$languages = Config::get('languages.languages');

		foreach ($languages as $code=>$language)
		{
			$lng = new Language();
			$lng->code = $code;
			$lng->name = $language['name'];
			$lng->native_name = $language['nativeName'];

			if ($code == "fr")
			{
				$lng->actif = "1";
			}

			$lng->save();
		}

    }
}
