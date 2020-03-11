<?php

namespace Modules\Formulaires\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Modules\Formulaires\Entities\Answer;
use Modules\Formulaires\Entities\Field;
use Modules\Formulaires\Entities\Formulaire;
use Modules\Formulaires\Http\Requests\AnswersRequest;
use Yajra\DataTables\DataTables;

class AnswersController extends Controller
{
	/**
	 * Show the specified resource.
	 * @return Response
	 */
	public function show(Formulaire $formulaire)
	{
		return view('formulaires::answers.show')->with('formulaire', $formulaire);
	}

	/**
	 * Show the form for creating a new resource.
	 * @param Formulaire $formulaire
	 * @return Response
	 */
    public function create(Formulaire $formulaire)
    {
        return view('formulaires::answers.create')->with('formulaire', $formulaire);
    }

	/**
	 * Store a newly created resource in storage.
	 * @param AnswersRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function store(AnswersRequest $request)
    {
		$request->validated();

		$answer = new Answer();
		$answer->formulaire_id = Input::get('formulaire_id');
		$answer->ip = $request->ip();

		$inputs = Input::all();
		$content = array();
		foreach ($inputs as $name => $value)
		{
			if ($name != '_token' && $name != '_method')
			{
				$content[$name] = $value;
			}
		}
		$answer->content = json_encode($content);
		$json = json_decode($answer->content, true);
        $answer->nom = $json['nom'];
        $answer->prenom = $json['prenom'];
		$answer->save();

		Session::flash('message', 'Vous avez bien créé une nouvelle réponse ! (BACK)');
		return Redirect::route('answers.show', Input::get('formulaire_id'));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Answer $answer)
    {
		return view('formulaires::answers.edit')
			->with('answer', $answer);
    }

	/**
	 * Update the specified resource in storage.
	 * @param AnswersRequest $request
	 * @param Answer $answer
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function update(AnswersRequest $request, Answer $answer)
    {
		$request->validated();

		$answer->formulaire_id = Input::get('formulaire_id');
		$answer->ip = $request->ip();

		// On récupère le donnée des inputs non présent dans le BO
		// (si on le fait pas les données sont supprimées, car on récrit tout le champ 'content')
		$inputs_fo_only = $answer->formulaire->fields->where('backoffice', 0);
		$content_old = json_decode($answer->content, true);

		//dd($inputs_fo_only);

		foreach ($inputs_fo_only as $key=>$field)
		{
			if (array_key_exists($field->name, $content_old))
			{
				$field->value = $content_old[$field->name];
			}
		}

		$inputs = Input::all();
		$content = array();
		foreach ($inputs as $name => $value)
		{
			if ($name != '_token' && $name != '_method')
			{
				$content[$name] = $value;
			}
		}

		foreach ($inputs_fo_only as $key=>$field)
		{
			$content[$field->name] = $field->value;
		}

		$answer->content = json_encode($content);
        $json = json_decode($answer->content, true);
        $answer->nom = $json['nom'];
        $answer->prenom = $json['prenom'];
		$answer->save();

		Session::flash('message', 'Vous avez bien édité de la réponse ! (BACK)');
		return Redirect::route('answers.show', Input::get('formulaire_id'));
    }

	/**
	 * Remove the specified resource from storage.
	 * @param Answer $answer
	 * @return boolean
	 * @throws \Exception
	 */
    public function destroy(Answer $answer)
    {
		if ($answer->delete()) {
			return '1';
		} else {
			return '0';
		}
    }

	/**
	 * Show the form for editing the specified resource.
	 * @return Response
	 */
	public function detail(Answer $answer)
	{
		return view('formulaires::answers.detail')
			->with('answer', $answer);
	}

	/**
	 * @param Formulaire $formulaire
	 * @return JSON
	 * @throws \Exception
	 */
	public function getBasicData(Formulaire $formulaire)
	{
		$answers = $formulaire->answers;

		return Datatables::of($answers)
			->addColumn('action', function ($answers) {
				return
					"<a href=\"" . route('answers.detail', $answers->id) . "\" class=\"m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill\" title=\"Prévisualiser\">
						<i class=\"la la-eye\"></i>
					</a>"
					."<a href=\"" . route('answers.edit', $answers->id) . "\" class=\"m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill\" title=\"Editer\">
						<i class=\"la la-edit\"></i>
					</a>"
					."<button class=\"m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill\" id=\"" . $answers->id . "\" title=\"Supprimer\" data-action=\"delete\">
						<i class=\"la la-trash\"></i>
					</button>";
			})
			//->removeColumn('password')
			->make(true);
	}

    /**
     * @param Formulaire $formulaire
     * @return JSON
     * @throws \Exception
     */
    public function getDataNotHandled(Formulaire $formulaire){
        $answers = $formulaire->answers->where('handled', '=', '0');
        return Datatables::of($answers)->make(true);
    }

	/**
	 * @param Answer $answer
	 * @return int
	 */
	public function handled (Answer $answer)
	{
		$answer->handled = 1;
		if ($answer->save()) {
			return 1;
		} else {
			return 0;
		}
	}

	/**
	 * @param Answer $answer
	 * @return int
	 */
	public function noHandled (Answer $answer)
	{
		$answer->handled = 0;
		if ($answer->save()) {
			return 1;
		} else {
			return 0;
		}
	}

    public function store_front(AnswersRequest $request)
	{
		// TODO: Définir une adresse de confirmation
		$request->validated();

		$answer = new Answer();
		$answer->formulaire_id = Input::get('formulaire_id');
		$answer->ip = $request->ip();

		$inputs = Input::all();
		$content = array();
		foreach ($inputs as $name => $value)
		{
			if ($name != '_token' && $name != '_method')
			{
				$content[$name] = $value;
			}
		}
		$answer->content = json_encode($content);
        $json = json_decode($answer->content, true);
        $answer->nom = $json['nom'];
        $answer->prenom = $json['prenom'];
		$answer->save();

		Session::flash('message', 'Vous avez bien créé une nouvelle réponse ! (FRONT)');
		return Redirect::route('answers.show', Input::get('formulaire_id'));
	}

	public function update_front(AnswersRequest $request, Answer $answer)
	{
		// TODO: Définir une adresse de confirmation
		$request->validated();

		$answer->formulaire_id = Input::get('formulaire_id');
		$answer->ip = $request->ip();

		$inputs = Input::all();
		$content = array();
		foreach ($inputs as $name => $value)
		{
			if ($name != '_token' && $name != '_method')
			{
				$content[$name] = $value;
			}
		}

		$answer->content = json_encode($content);
        $json = json_decode($answer->content, true);
        $answer->nom = $json['nom'];
        $answer->prenom = $json['prenom'];
		$answer->save();

		Session::flash('message', 'Vous avez bien édité de la réponse ! (FRONT)');
		return Redirect::route('answers.show', Input::get('formulaire_id'));
	}
}
