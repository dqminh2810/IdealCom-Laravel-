<?php

namespace Modules\Formulaires\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Modules\Formulaires\Entities\Field;
use Modules\Formulaires\Entities\Choice;
use Modules\Formulaires\Http\Requests\ChoicesRequest;
use PHPUnit\Util\Json;
use Yajra\DataTables\DataTables;

class ChoicesController extends Controller
{

	/**
	 * Display a listing of the resource.
	 * @param Field $field
	 * @return Response
	 */
	public function show(Field $field)
	{
		return view('formulaires::choices.show')->with('field', $field);
	}

	/**
	 * Show the form for creating a new resource.
	 * @param Field $field
	 * @return Response
	 */
	public function create(Field $field)
	{
		return view('formulaires::choices.create')->with('field', $field);
	}

	/**
	 * Store a newly created resource in storage.
	 * @param ChoicesRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(ChoicesRequest $request)
	{
		$request->validated();

		$choice = new Choice();
		$choice->field_id = Input::get('field_id');
		$choice->label = Input::get('label');
		$choice->value = Input::get('value');
		$choice->selected = Input::get('selected');

		if (Input::get('actif') === null){
			$choice->actif = 0;
		} else {
			$choice->actif = 1;
		}

		$choice->save();

		Session::flash('message', 'Vous avez bien créé un nouveau choix !');
		return Redirect::route('choices.show', Input::get('field_id'));

	}

	/**
	 * Show the form for editing the specified resource.
	 * @param Choice $choice
	 * @return Response
	 */
	public function edit(Choice $choice)
	{
		$field = $choice->field;
		return view('formulaires::choices.edit')
			->with('choice', $choice)
			->with('field', $field);
	}

	/**
	 * Update the specified resource in storage.
	 * @param ChoicesRequest $request
	 * @param Choice $choice
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(ChoicesRequest $request, Choice $choice)
	{
		$request->validated();

		$choice->field_id = Input::get('field_id');
		$choice->label = Input::get('label');
		$choice->value = Input::get('value');
		$choice->selected = Input::get('selected');

		if (Input::get('actif') === null){
			$choice->actif = 0;
		} else {
			$choice->actif = 1;
		}

		$choice->save();

		Session::flash('message', 'Vous avez bien édité le choix !');
		return Redirect::route('choices.show', Input::get('field_id'));
	}

	/**
	 * Remove the specified resource from storage.
	 * @param Choice $choice
	 * @return boolean
	 * @throws \Exception
	 */
	public function destroy(Choice $choice)
	{
		if ($choice->delete()) {
			return '1';
		} else {
			return '0';
		}
	}

	/**
	 * @param Field $field
	 * @return Json
	 * @throws \Exception
	 */
	public function getBasicData(Field $field)
	{
		//dd($formulaire->field);
		$choices = $field->choices;
		//dd($choices);
		//Choice::select(['id','name','label_bo','backoffice','type','actif','created_at','updated_at']);

		return Datatables::of($choices)
			->addColumn('action', function ($choices) {
				return
					"<a href=\"" . route('choices.edit', $choices->id) . "\" class=\"m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill\" title=\"Editer\">
						<i class=\"la la-edit\"></i>
					</a>"
					."<button class=\"m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill\" id=\"" . $choices->id . "\" title=\"Supprimer\" data-action=\"delete\">
						<i class=\"la la-trash\"></i>
					</button>";
			})
			//->removeColumn('password')
			->make(true);
	}

	/**
	 * @param Choice $choice
	 * @return int
	 */
	public function enable (Choice $choice)
	{
		$choice->actif = 1;
		if ($choice->save()) {
			return 1;
		} else {
			return 0;
		}
	}

	/**
	 * @param Choice $choice
	 * @return int
	 */
	public function disable (Choice $choice)
	{
		$choice->actif = 0;
		if ($choice->save()) {
			return 1;
		} else {
			return 0;
		}
	}

    /**
     * @param Choice $choice
     * @return int
     */
    public function select (Choice $choice)
    {
        $choice->selected = 1;
        if ($choice->save()) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * @param Choice $choice
     * @return int
     */
    public function unselect (Choice $choice)
    {
        $choice->selected = 0;
        if ($choice->save()) {
            return 1;
        } else {
            return 0;
        }
    }
}
