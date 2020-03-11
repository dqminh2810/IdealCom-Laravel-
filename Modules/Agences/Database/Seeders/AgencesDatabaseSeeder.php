<?php

namespace Modules\Agences\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Agences\Entities\Agence;

class AgencesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $agence = new Agence();
        $agence->name = "Ideal-Com";
        $agence->web_agence = "1";
        $agence->address = "VILLANTIPOLIS Villa n°6";
        $agence->complement = "473 route des Dolines";
        $agence->zip_code = "06560";
        $agence->city = "Sophia Antipolis";
        $agence->country_id = "75";
        $agence->website = "https://www.ideal-com.com/";
        $agence->email = "infos@ideal-com.com";
        $agence->actif = "1";
        $agence->save();

    }
}
