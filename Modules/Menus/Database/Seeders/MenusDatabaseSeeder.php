<?php

namespace Modules\Menus\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Menus\Entities\Menu;
use Modules\Menus\Entities\MenuItem;

class MenusDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	/* MENUS */
    	// Création du menu ACCUEIL
        $accueil = new Menu();
		$accueil->name = "ACCUEIL";
		$accueil->display_name = "Accueil";
		$accueil->position = 0;
		$accueil->home = 1;
		$accueil->actif = 1;
		$accueil->save();

		// Création du menu PRINICPAL
		$principal = new Menu();
		$principal->name = "PRINCIPAL";
		$principal->display_name = "Principal";
		$principal->position = 1;
		$principal->home = 0;
		$principal->actif = 1;
		$principal->save();

		// Création du menu FOOTER
		$footer = new Menu();
		$footer->name = "FOOTER";
		$footer->display_name = "Footer";
		$footer->position = 2;
		$footer->home = 0;
		$footer->actif = 1;
		$footer->save();


		/* MENUITEMS */
		$mi1 = new MenuItem();
		$mi1->name = "Produits";
		$mi1->display_name = " Gallerie";
		$mi1->menu_id = $principal->id;
		$mi1->left = 1;
		$mi1->right = 6;
		$mi1->level = 1;
		$mi1->actif = 1;
		$mi1->save();
		$mi1->arbre_id = $mi1->id;
		$mi1->save();

		$mi11 = new MenuItem();
		$mi11->name = "Coca";
		$mi11->display_name = "Coca-Cola";
		$mi11->menu_id = $principal->id;
		$mi11->parent_id = $mi1->id;
		$mi11->left = 2;
		$mi11->right = 5;
		$mi11->level = 2;
		$mi11->actif = 1;
		$mi11->save();
		$mi11->arbre_id = $mi1->id;
		$mi11->save();

		$mi12 = new MenuItem();
		$mi12->name = "Sprite";
		$mi12->display_name = "Sprite";
		$mi12->menu_id = $principal->id;
		$mi12->parent_id = $mi11->id;
		$mi12->left = 3;
		$mi12->right = 4;
		$mi12->level = 3;
		$mi12->actif = 1;
		$mi12->save();
		$mi12->arbre_id = $mi1->id;
		$mi12->save();

		$mi2 = new MenuItem();
		$mi2->name = "Gallerie";
		$mi2->display_name = " Gallerie";
		$mi2->menu_id = $principal->id;
		$mi2->left = 1;
		$mi2->right = 2;
		$mi2->level = 1;
		$mi2->actif = 1;
		$mi2->save();
		$mi2->arbre_id = $mi2->id;
		$mi2->save();
    }

}
