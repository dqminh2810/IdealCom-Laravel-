<?php

namespace Modules\Formulaires\Helpers;


use Kris\LaravelFormBuilder\Facades\FormBuilder;
use Modules\Formulaires\Entities\Formulaire;
use Modules\Formulaires\Forms\BaseForm;

class FormulairesHelper {

	public static function formbuilder ($uuid, $method = "POST",  $backoffice = false, $answer_id = null)
	{
		// TODO: Définir une adresse de confirmation
		$formulaire = Formulaire::where('uuid', $uuid)->first();

		if ($backoffice == true)
		{
			if ($method == "POST")
			{
				$route = ['answers.store'];
			}
			else
			{
				$route = ['answers.update', $answer_id];
			}
		}
		else
		{
			if ($method == "POST")
			{
				$route = ['formbuilder.store_front'];
			}
			else
			{
				$route = ['formbuilder.update_front', $answer_id];
			}
		}


		if ($formulaire != null) {
			$formbuilder = FormBuilder::create(BaseForm::class, [
				'route' => $route,
				'method' => $method,
				'data' => [
					'id' => $formulaire->id,
					'method' => $method,
					'backoffice' => $backoffice,
					'answer_id' => $answer_id,
				]
			]);
			return form($formbuilder);
		}
		return "Erreur: Formulaire introuvable";
	}

}