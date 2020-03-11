<?php

namespace Modules\Formulaires\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Formulaires\Entities\Answer;
use Modules\Formulaires\Entities\Choice;
use Modules\Formulaires\Entities\Field;
use Modules\Formulaires\Entities\Formulaire;

class FormulairesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		// Formulaire de contact
		$formulaire = new Formulaire();

		$formulaire->uuid = "CONTACT";
		$formulaire->title = "Nous contacter";
		$formulaire->name_from = "Ideal-Com";
		$formulaire->email_from = "info@ideal-com.com";
		$formulaire->email_to = "guillaume@ideal-com.com";
		$formulaire->email_to_cc = "";
		$formulaire->actif = "1";

		$formulaire->save();


		// Champs du formulaires
		$nom = new Field();
		$nom->name = "nom";
		$nom->position = "0";
		$nom->formulaire_id = $formulaire->id;
		$nom->backoffice = "1";
		$nom->label_bo = "Nom :";
		$nom->label_fo = "Nom :";
		$nom->type = "text";
		$nom->placeholder = "Votre nom";
		$nom->required = "1";
		$nom->save();

		$prenom = new Field();
		$prenom->name = "prenom";
		$prenom->position = "1";
		$prenom->formulaire_id = $formulaire->id;
		$prenom->backoffice = "1";
		$prenom->label_bo = "Prénom :";
		$prenom->label_fo = "Prénom :";
		$prenom->type = "text";
		$prenom->placeholder = "Votre Prénom";
		$prenom->required = "1";
		$prenom->save();

		$prenom = new Field();
		$prenom->name = "email";
		$prenom->position = "2";
		$prenom->formulaire_id = $formulaire->id;
		$prenom->backoffice = "1";
		$prenom->label_bo = "Email :";
		$prenom->label_fo = "Email :";
		$prenom->type = "email";
		$prenom->placeholder = "Votre Email";
		$prenom->required = "1";
		$prenom->save();

		$tel = new Field();
		$tel->name = "tel";
		$tel->position = "3";
		$tel->formulaire_id = $formulaire->id;
		$tel->backoffice = "1";
		$tel->label_bo = "Téléphone :";
		$tel->label_fo = "Téléphone :";
		$tel->type = "tel";
		$tel->placeholder = "Votre Numéro de Téléphone";
		$tel->required = "1";
		$tel->save();

		$msg = new Field();
		$msg->name = "msg";
		$msg->position = "4";
		$msg->formulaire_id = $formulaire->id;
		$msg->backoffice = "1";
		$msg->label_bo = "Message :";
		$msg->label_fo = "Message :";
		$msg->type = "textarea";
		$msg->placeholder = "Votre Message ...";
		$msg->required = "1";
		$msg->save();

		$lng = new Field();
		$lng->name = "lng";
		$lng->position = "5";
		$lng->formulaire_id = $formulaire->id;
		$lng->backoffice = "1";
		$lng->label_bo = "Langage :";
		$lng->label_fo = "Langage :";
		$lng->type = "select";
		$lng->multiple = "0";
		$lng->required = "1";
		$lng->save();

		$fr = new Choice();
		$fr->field_id = $lng->id;
		$fr->label = "Français";
		$fr->value = "fr";
		$fr->selected = "1";
		$fr->actif = "1";
		$fr->save();

		$en = new Choice();
		$en->field_id = $lng->id;
		$en->label = "Anglais";
		$en->value = "en";
		$en->selected = "0";
		$en->actif = "1";
		$en->save();

		// Réponses
		$rep1 = new Answer();
		$rep1->formulaire_id = $formulaire->id;
		$rep1->content = '{"msg": "Salut !", "nom": "Guillaume", "tel": "0682209302", "email": "gladorme@gmail.com", "prenom": "Ladorme", "lng": ["fr"], "formulaire_id": "'.$formulaire->id.'"}';
		$json = json_decode($rep1->content, true);
		$rep1->nom = $json['nom'];
        $rep1->prenom = $json['prenom'];
		$rep1->ip = "192.168.0.1";
		$rep1->handled = "1";
		$rep1->save();

		$rep2 = new Answer();
		$rep2->formulaire_id = $formulaire->id;
		$rep2->content = '{"msg": "Hola !", "nom": "Largeron", "tel": "0606060606", "email": "d.largeron@ideal-com.com", "prenom": "Didier", "lng": ["fr","en"], "formulaire_id": "'.$formulaire->id.'"}';
        $json = json_decode($rep2->content, true);
        $rep2->nom = $json['nom'];
        $rep2->prenom = $json['prenom'];
		$rep2->ip = "192.168.0.1";
		$rep2->handled = "0";
		$rep2->save();
    }
}
