<?php

namespace Modules\Formulaires\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Modules\Formulaires\Entities\Field;
use Modules\Formulaires\Entities\Formulaire;
use Modules\Formulaires\Http\Requests\FieldsRequest;
use PHPUnit\Util\Json;
use Yajra\DataTables\DataTables;

class FieldsController extends Controller
{

	/**
	 * Display a listing of the resource.
	 * @param Formulaire $formulaire
	 * @return Response
	 */
	public function show(Formulaire $formulaire)
	{
		return view('formulaires::fields.show')->with('formulaire', $formulaire);
	}

	/**
	 * Show the form for creating a new resource.
	 * @param Formulaire $formulaire
	 * @return Response
	 */
	public function create(Formulaire $formulaire)
	{
		return view('formulaires::fields.create')->with('formulaire', $formulaire);
	}

	/**
	 * Store a newly created resource in storage.
	 * @param FieldsRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(FieldsRequest $request)
	{
		$request->validated();

		$field = new Field();
		$field->name = strtolower(Input::get('name'));
		$field->formulaire_id = Input::get('formulaire_id');
		$field->backoffice = Input::get('backoffice');
		$field->label_bo = Input::get('label_bo');
		$field->label_fo = Input::get('label_fo');
		$field->type = Input::get('type');
		$field->required = Input::get('required');

		if (Input::get('placeholder') != null)
		{
			$field->placeholder = Input::get('placeholder');
		}

		if (Input::get('value') != null)
		{
			$field->value = Input::get('value');
		}

		if (Input::get('min') != null)
		{
			$field->min = Input::get('min');
		}

		if (Input::get('max') != null)
		{
			$field->max = Input::get('max');
		}

		if (Input::get('step') != null)
		{
			$field->step = Input::get('step');
		}

		if (Input::get('col') != null)
		{
			$field->col = Input::get('col');
		}

		if (Input::get('rows') != null)
		{
			$field->rows = Input::get('rows');
		}

		if (Input::get('accept') != null)
		{
			$field->accept = Input::get('accept');
		}

		if (Input::get('multiple') != null)
		{
			$field->multiple = Input::get('multiple');
		}

		if (Input::get('tag') != null)
		{
			$field->tag = Input::get('tag');;
		}

		if (Input::get('class') != null)
		{
			$field->class = Input::get('class');
		}

		if (Input::get('error_messages') != null)
		{
			$field->error_messages = Input::get('error_messages');
		}

		if (Input::get('actif') === null){
			$field->actif = 0;
		} else {
			$field->actif = 1;
		}

		$last_field = Field::where('formulaire_id', $field->formulaire_id)->orderBy('position', 'desc')->first();
		if ($last_field != null)
		{
			$field->position = $last_field->position + 1;
		}
		else
		{
			$field->position = 0;
		}

		$field->save();

		Session::flash('message', 'Vous avez bien créé un nouveau champ !');
		return Redirect::route('fields.show', Input::get('formulaire_id'));

	}

	/**
	 * Show the form for editing the specified resource.
	 * @param Field $field
	 * @return Response
	 */
	public function edit(Field $field)
	{
		$formulaire = $field->formulaire;
		return view('formulaires::fields.edit')
			->with('field', $field)
			->with('formulaire', $formulaire);
	}

	/**
	 * Update the specified resource in storage.
	 * @param FieldsRequest $request
	 * @param Field $field
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(FieldsRequest $request, Field $field)
	{
		$request->validated();


		$field->name = strtolower(Input::get('name'));
		$field->formulaire_id = Input::get('formulaire_id');
		$field->backoffice = Input::get('backoffice');
		$field->label_bo = Input::get('label_bo');
		$field->label_fo = Input::get('label_fo');
		$field->type = Input::get('type');
		$field->required = Input::get('required');


		if (Input::get('placeholder') != null)
		{
			$field->placeholder = Input::get('placeholder');;
		}

		if (Input::get('value') != null)
		{
			$field->value = Input::get('value');;
		}

		if (Input::get('min') != null)
		{
			$field->min = Input::get('min');;
		}

		if (Input::get('max') != null)
		{
			$field->max = Input::get('max');;
		}

		if (Input::get('step') != null)
		{
			$field->step = Input::get('step');;
		}

		if (Input::get('col') != null)
		{
			$field->col = Input::get('col');;
		}

		if (Input::get('rows') != null)
		{
			$field->rows = Input::get('rows');;
		}

		if (Input::get('accept') != null)
		{
			$field->accept = Input::get('accept');;
		}

		if (Input::get('multiple') != null)
		{
			$field->multiple = Input::get('multiple');;
		}

		if (Input::get('tag') != null)
		{
			$field->tag = Input::get('tag');;
		}

		if (Input::get('actif') === null)
		{
			$field->actif = 0;
		} else {
			$field->actif = 1;
		}

		if (Input::get('class') != null)
		{
			$field->class = Input::get('class');
		}

		if (Input::get('error_messages') != null)
		{
			$field->error_messages = Input::get('error_messages');
		}

		$field->save();

		Session::flash('message', 'Vous avez bien édité le champ !');
		return Redirect::route('fields.show', Input::get('formulaire_id'));
	}

	/**
	 * Remove the specified resource from storage.
	 * @param Field $field
	 * @return boolean
	 * @throws \Exception
	 */
	public function destroy(Field $field)
	{
		if ($field->delete()) {
			return '1';
		} else {
			return '0';
		}
	}

	/**
	 * @param Formulaire $formulaire
	 * @return Json
	 * @throws \Exception
	 */
	public function getBasicData(Formulaire $formulaire)
	{
		$fields = $formulaire->fields;

		return Datatables::of($fields)
			->addColumn('action', function ($fields) {
				if ($fields->type == "select" || $fields->type == "radio" || $fields->type == "checkbox")
				{
					return
					link_to_route('choices.show', 'Choix', array('field'=>$fields->id), array('class'=>'btn btn-small btn-brand')) . "	"
					."<a href=\"" . route('fields.edit', $fields->id) . "\" class=\"m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill\" title=\"Prévisualiser\">
						<i class=\"la la-edit\"></i>
					</a>"
					."<button class=\"m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill\" id=\"" . $fields->id . "\" title=\"Supprimer\" data-action=\"delete\">
						<i class=\"la la-trash\"></i>
					</button>";
				} else {
					return
						"<a href=\"" . route('fields.edit', $fields->id) . "\" class=\"m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill\" title=\"Prévisualiser\">
						<i class=\"la la-edit\"></i>
					</a>"
						."<button class=\"m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill\" id=\"" . $fields->id . "\" title=\"Supprimer\" data-action=\"delete\">
						<i class=\"la la-trash\"></i>
					</button>";
				}
			})
			//->removeColumn('password')
			->make(true);
	}

	/**
	 * @param Field $field
	 * @return int
	 */
	public function enable (Field $field)
	{
		$field->actif = 1;
		if ($field->save()) {
			return 1;
		} else {
			return 0;
		}
	}

	/**
	 * @param Field $field
	 * @return int
	 */
	public function disable (Field $field)
	{
		$field->actif = 0;
		if ($field->save()) {
			return 1;
		} else {
			return 0;
		}
	}

	/**
	 * @param Field $field
	 * @return int
	 */
	public function frontoffice (Field $field)
	{
		$field->backoffice = 0;
		if ($field->save()) {
			return 1;
		} else {
			return 0;
		}
	}

	/**
	 * @param Field $field
	 * @return int
	 */
	public function backoffice (Field $field)
	{
		$field->backoffice = 1;
		if ($field->save()) {
			return 1;
		} else {
			return 0;
		}
	}

	public static function getListTypeForFields()
	{
		$fields = self::getListType();
		$list = array();

		foreach ($fields as $type=>$details) {
			$list[$type] = $type;
		}


		return $list;
	}

	public static function getListType()
	{
		return Config::get('formulaires.fields');
	}

	public function updatePosition(Field $field, int $position)
	{
		$field->position = $position;

		if ($field->save()) {
			return 1;
		} else {
			return 0;
		}
	}
}
