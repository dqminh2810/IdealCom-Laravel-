<?php

namespace Modules\Domains\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Modules\Agences\Entities\Agence;
use Modules\Domains\Entities\Domain;
use Modules\Domains\Http\Requests\DomainsRequest;
use Yajra\DataTables\DataTables;

class DomainsController extends Controller
{
	/**
	 * Display a listing of the resource.
	 * @return Response
	 */
	public function index()
	{
		return view('domains::index');
	}

	/**
	 * Show the form for creating a new resource.
	 * @return Response
	 */
	public function create()
	{
		return view('domains::create');
	}

	/**
	 * Store a newly created resource in storage.
	 * @param DomainsRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(DomainsRequest $request)
	{
		$request->validated();

		$domain = new Domain();
		$domain->code = Input::get('code');
		$domain->name = Input::get('name');
		$domain->display_name = Input::get('display_name');
		$domain->country_id = Input::get('country_id');
		$domain->extension = Input::get('extension');
		$domain->google_analytics = Input::get('google_analytics');
		$domain->google_webmastertool = Input::get('google_webmastertool');
		$domain->google_maps = Input::get('google_maps');

		if (Input::get('actif') === null){
			$domain->actif = 0;
		} else {
			$domain->actif = 1;
		}

		$domain->save();


		Session::flash('message', 'Vous avez bien créé un nouveau domaine !');
		return Redirect::route('domains.index');
	}

	/**
	 * Show the specified resource.
	 * @param Domain $domain
	 * @return Response
	 */
	public function show(Domain $domain)
	{
		return view('domains::show')->with('domain', $domain);
	}

	/**
	 * Show the form for editing the specified resource.
	 * @param Domain $domain
	 * @return Response
	 */
	public function edit(Domain $domain)
	{
		return view('domains::edit')->with('domain', $domain);
	}

	/**
	 * Update the specified resource in storage.
	 * @param DomainsRequest $request
	 * @param Domain $domain
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(DomainsRequest $request, Domain $domain)
	{
		$request->validated();

		$domain->code = Input::get('code');
		$domain->name = Input::get('name');
		$domain->display_name = Input::get('display_name');
		$domain->country_id = Input::get('country_id');
		$domain->extension = Input::get('extension');
		$domain->google_analytics = Input::get('google_analytics');
		$domain->google_webmastertool = Input::get('google_webmastertool');
		$domain->google_maps = Input::get('google_maps');

		if (Input::get('actif') === null){
			$domain->actif = 0;
		} else {
			$domain->actif = 1;
		}

		$domain->save();


		Session::flash('message', 'Vous avez bien édité le domaine !');
		return Redirect::route('domains.index');
	}

	/**
	 * Remove the specified resource from storage.
	 * @param Domain $domain
	 * @return int
	 * @throws \Exception
	 */
	public function destroy(Domain $domain)
	{
		if ($domain->delete()) {
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
		$domains = Domain::select(['id','code','display_name','name','country_id','actif','created_at','updated_at']);

		return Datatables::of($domains)
			->addColumn('action', function ($domains) {
				return
					"<a href=\"" . route('domains.edit', $domains->id) . "\" class=\"m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill\" title=\"Editer\">
						<i class=\"la la-edit\"></i>
					</a>"
					."<button class=\"m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill\" id=\"" . $domains->id . "\" title=\"Supprimer\" data-action=\"delete\">
						<i class=\"la la-trash\"></i>
					</button>";
			})
			->editColumn('country_id', '{{ Modules\Countries\Entities\Country::where("id",$country_id)->first()->name }}')
			//->removeColumn('password')
			->make(true);
	}

	/**
	 * @return mixed
	 * @throws \Exception
	 */
	public function getDatatableAgence(Agence $agence)
	{
		$domains = $agence->domains;
		return Datatables::of($domains)
			->addColumn('action', function ($domains) use ($agence) {
				return
					"<button class=\"m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill\" id=\"" . $domains->id . "\" data-agence_id=\"" . $agence->id . "\" title=\"Désassocier\" data-action=\"remove\">
						<i class=\"la la-remove\"></i>
					</button>";
			})
			->editColumn('country_id', '{{ Modules\Countries\Entities\Country::where("id",$country_id)->first()->name }}')
			//->removeColumn('password')
			->make(true);
	}

	/**
	 * @param Domain $domain
	 * @return int|mixed
	 */
	public function enable (Domain $domain)
	{
		$domain->actif = 1;
		if ($domain->save()) {
			return 1;
		} else {
			return 0;
		}
	}

	/**
	 * @param Domain $domain
	 * @return int|mixed
	 */
	public function disable (Domain $domain)
	{
		$domain->actif = 0;
		if ($domain->save()) {
			return 1;
		} else {
			return 0;
		}
	}

}
