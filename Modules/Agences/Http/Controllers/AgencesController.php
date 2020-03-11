<?php

namespace Modules\Agences\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Modules\Agences\Entities\Agence;
use Modules\Agences\Http\Requests\AgencesRequest;
use Modules\Domains\Entities\Domain;
use Yajra\DataTables\DataTables;

class AgencesController extends Controller
{
	/**
	 * Display a listing of the resource.
	 * @return Response
	 */
	public function index()
	{
		return view('agences::index');
	}

	/**
	 * Show the form for creating a new resource.
	 * @return Response
	 */
	public function create()
	{
		return view('agences::create');
	}

	/**
	 * Store a newly created resource in storage.
	 * @param AgencesRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(AgencesRequest $request)
	{
		$request->validated();

		$agence = new Agence();
		$agence->name = Input::get('name');
		$agence->web_agence = Input::get('web_agence');
		$agence->address = Input::get('address');
		$agence->complement = Input::get('complement');
		$agence->zip_code = Input::get('zip_code');
		$agence->city = Input::get('city');
		$agence->country_id = Input::get('country_id');
		$agence->website = Input::get('website');
		$agence->email = Input::get('email');

		if (Input::get('actif') === null){
			$agence->actif = 0;
		} else {
			$agence->actif = 1;
		}

		$agence->save();


		Session::flash('message', 'Vous avez bien créé une nouvelle agence !');
		return Redirect::route('agences.index');
	}

	/**
	 * Show the specified resource.
	 * @param Agence $agence
	 * @return Response
	 */
	public function show(Agence $agence)
	{
		return view('agences::show')->with('agence', $agence);
	}

	/**
	 * Show the form for editing the specified resource.
	 * @param Agence $agence
	 * @return Response
	 */
	public function edit(Agence $agence)
	{
		return view('agences::edit')->with('agence', $agence);
	}

	/**
	 * Update the specified resource in storage.
	 * @param AgencesRequest $request
	 * @param Agence $agence
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(AgencesRequest $request, Agence $agence)
	{
		$request->validated();

		$agence->name = Input::get('name');
		$agence->web_agence = Input::get('web_agence');
		$agence->address = Input::get('address');
		$agence->complement = Input::get('complement');
		$agence->zip_code = Input::get('zip_code');
		$agence->city = Input::get('city');
		$agence->country_id = Input::get('country_id');
		$agence->website = Input::get('website');
		$agence->email = Input::get('email');

		if (Input::get('actif') === null){
			$agence->actif = 0;
		} else {
			$agence->actif = 1;
		}

		$agence->save();


		Session::flash('message', 'Vous avez bien édité l\'agence !');
		return Redirect::route('agences.index');
	}

	/**
	 * Remove the specified resource from storage.
	 * @param Agence $agence
	 * @return int
	 * @throws \Exception
	 */
	public function destroy(Agence $agence)
	{
		if ($agence->delete()) {
			return 1;
		} else {
			return 0;
		}
	}

	/**
	 * @return mixed
	 * @throws \Exception
	 */
	public function getBasicData()
	{
		$agences = Agence::select(['id','name','actif','created_at','updated_at']);

		return Datatables::of($agences)
			->addColumn('action', function ($agences) {
				return
					"<a href=\"" . route('agences.show', $agences->id) . "\" class=\"m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill\" title=\"Prévisualiser\">
						<i class=\"la la-eye\"></i>
					</a>"
					."<a href=\"" . route('agences.edit', $agences->id) . "\" class=\"m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill\" title=\"Editer\">
						<i class=\"la la-edit\"></i>
					</a>"
					."<button class=\"m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill\" id=\"" . $agences->id . "\" title=\"Supprimer\" data-action=\"delete\">
						<i class=\"la la-trash\"></i>
					</button>";
			})
			->make(true);
	}

	/**
	 * @param Agence $agence
	 * @return int|mixed
	 */
	public function enable (Agence $agence)
	{
		$agence->actif = 1;
		if ($agence->save()) {
			return 1;
		} else {
			return 0;
		}
	}

	/**
	 * @param Agence $agence
	 * @return int|mixed
	 */
	public function disable (Agence $agence)
	{
		$agence->actif = 0;
		if ($agence->save()) {
			return 1;
		} else {
			return 0;
		}
	}

	/**
	 * Remove the specified resource from storage.
	 * @param Agence $agence
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function addDomain(Agence $agence)
	{
		$domain = Domain::where('id', Input::get('domain_id'))->first();

		if ($agence->domains()->where('domain_id', $domain->id)->exists())
		{
			Session::flash('message', 'Erreur: Le domaine est déjà associé à l\'agence');
			return Redirect::route('agences.show', $agence->id);
		}
		else
		{
			$agence->domains()->attach($domain);
			Session::flash('message', 'Vous avez bien associé le domaine à l\'agence !');
			return Redirect::route('agences.show', $agence->id);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 * @param Agence $agence
	 * @return int
	 * @throws \Exception
	 */
	public function removeDomain(Agence $agence, Domain $domain)
	{
		if ($agence->domains()->where('domain_id', $domain->id)->exists())
		{
			$agence->domains()->detach($domain);
			return 1;
		}
		else
		{
			return 0;
		}
	}
}
