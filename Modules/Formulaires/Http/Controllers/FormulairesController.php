<?php

namespace Modules\Formulaires\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Kris\LaravelFormBuilder\Facades\FormBuilder;
use Modules\Formulaires\Entities\Formulaire;
use Modules\Formulaires\Forms\BaseForm;
use Modules\Formulaires\Http\Requests\FormulairesRequest;
use PHPUnit\Util\Json;
use Yajra\DataTables\DataTables;

class FormulairesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('formulaires::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('formulaires::create');
    }

		/**
		 * Store a newly created resource in storage.
		 * @param FormulairesRequest $request
		 * @return \Illuminate\Http\RedirectResponse
		 */
    public function store(FormulairesRequest $request)
    {
    	$request->validated();

		$formulaire = new Formulaire();
		$formulaire->uuid = strtoupper(Input::get('uuid'));
		$formulaire->title = Input::get('title');
		$formulaire->name_from = Input::get('name_from');
		$formulaire->email_from = Input::get('email_from');
		$formulaire->email_to = Input::get('email_to');
		$formulaire->email_to_cc = Input::get('email_to_cc');

		if (Input::get('actif') === null){
			$formulaire->actif = 0;
		} else {
			$formulaire->actif = 1;
		}

		$formulaire->save();

		Session::flash('message', 'Vous avez bien créé un nouveau formulaire !');
		return Redirect::route('formulaires.index');
    }

	/**
	 * Show the specified resource.
	 * @param Formulaire $formulaire
	 * @return Response
	 */
    public function show(Formulaire $formulaire)
		{
        return view('formulaires::show')->with('formulaire', $formulaire);
    }

	/**
	 * Show the form for editing the specified resource.
	 * @param Formulaire $formulaire
	 * @return Response
	 */
    public function edit(Formulaire $formulaire)
    {
        return view('formulaires::edit')->with('formulaire', $formulaire);
    }

	/**
	 * Update the specified resource in storage.
	 * @param FormulairesRequest $request
	 * @param Formulaire $formulaire
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function update(FormulairesRequest $request, Formulaire $formulaire)
    {
		$request->validated();

		$formulaire->uuid = strtoupper(Input::get('uuid'));
		$formulaire->title = Input::get('title');
		$formulaire->name_from = Input::get('name_from');
		$formulaire->email_from = Input::get('email_from');
		$formulaire->email_to = Input::get('email_to');
		$formulaire->email_to_cc = Input::get('email_to_cc');

		if (Input::get('actif') === null){
			$formulaire->actif = 0;
		} else {
			$formulaire->actif = 1;
		}

		$formulaire->save();

		Session::flash('message', 'Vous avez bien édité le formulaire !');
		return Redirect::route('formulaires.index');
    }

	/**
	 * Remove the specified resource from storage.
	 * @param Formulaire $formulaire
	 * @return boolean
	 * @throws \Exception
	 */
    public function destroy(Formulaire $formulaire)
    {
			if ($formulaire->delete()) {
    		return '1';
			} else {
    		return '0';
			}
    }

	/**
	 * @return Json
	 * @throws \Exception
	 */
	public function getBasicData()
	{
		$formulaires = Formulaire::select(['id','uuid','title','actif','created_at','updated_at']);

		return Datatables::of($formulaires)
			->addColumn('action', function ($formulaires) {
				return
					link_to_route('fields.show', 'Champs', array('formulaire'=>$formulaires->id), array('class'=>'btn btn-small btn-brand'))."	"
					. link_to_route('answers.show', 'Réponses', array('formulaire'=>$formulaires->id), array('class'=>'btn btn-small btn-accent'))."	"
					. "<a href=\"" . route('formulaires.show', $formulaires->id) . "\" class=\"m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill\" title=\"Prévisualiser\">
						<i class=\"la la-eye\"></i>
					</a>"
					."<a href=\"" . route('formulaires.edit', $formulaires->id) . "\" class=\"m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill\" title=\"Editer\">
						<i class=\"la la-edit\"></i>
					</a>"
					."<button class=\"m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill\" id=\"" . $formulaires->id . "\" title=\"Supprimer\" data-action=\"delete\">
						<i class=\"la la-trash\"></i>
					</button>";
			})
			//->removeColumn('password')
			->make(true);
	}

	/**
	 * @param Formulaire $formulaire
	 * @return int|mixed
	 */
	public function enable (Formulaire $formulaire)
	{
		$formulaire->actif = 1;
		if ($formulaire->save()) {
			return 1;
		} else {
			return 0;
		}
	}

	/**
	 * @param Formulaire $formulaire
	 * @return int|mixed
	 */
	public function disable (Formulaire $formulaire)
	{
		$formulaire->actif = 0;
		if ($formulaire->save()) {
			return 1;
		} else {
			return 0;
		}
	}
}
