<?php

namespace Modules\Countries\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Modules\Countries\Entities\Country;
use Modules\Countries\Http\Requests\CountriesRequest;
use Yajra\DataTables\DataTables;

class CountriesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('countries::index');
    }

	/**
	 * Show the form for editing the specified resource.
	 * @param Country $country
	 * @return Response
	 */
    public function edit(Country $country)
    {
        return view('countries::edit')->with('country', $country);
    }

	/**
	 * Update the specified resource in storage.
	 * @param CountriesRequest $request
	 * @param Country $country
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function update(CountriesRequest $request, Country $country)
    {
		$request->validated();

		$country->code = Input::get('code');
		$country->name = Input::get('name');
		$country->alpha2 = Input::get('alpha2');
		$country->alpha3 = Input::get('alpha3');

		$country->save();


		Session::flash('message', 'Vous avez bien édité le pays !');
		return Redirect::route('countries.index');
    }

	/**
	 * Remove the specified resource from storage.
	 * @param Country $country
	 * @return int
	 * @throws \Exception
	 */
    public function destroy(Country $country)
    {
		if ($country->delete()) {
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
		$countries = Country::select(['id','name','code','alpha2','alpha3']);

		return Datatables::of($countries)
			->addColumn('action', function ($countries) {
				return
					"<a href=\"" . route('countries.edit', $countries->id) . "\" class=\"m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill\" title=\"Editer\">
						<i class=\"la la-edit\"></i>
					</a>"
					."<button class=\"m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill\" id=\"" . $countries->id . "\" title=\"Supprimer\" data-action=\"delete\">
						<i class=\"la la-trash\"></i>
					</button>";
			})
			//->removeColumn('password')
			->make(true);
	}
}
