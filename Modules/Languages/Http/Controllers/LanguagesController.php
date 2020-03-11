<?php

namespace Modules\Languages\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Modules\Languages\Entities\Language;
use Modules\Languages\Http\Requests\LanguagesRequest;
use Yajra\DataTables\DataTables;

class LanguagesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @param $locale
     * @return Response
     */
    public function index(Request $request, $locale=null)
    {
        return view('languages::index');
        //set’s application’s locale
        //app()->setLocale($locale);

        //Gets the translated message and displays it
        //echo trans('message.msg');
    }

	/**
	 * Show the form for editing the specified resource.
	 * @param Language $language
	 * @return Response
	 */
    public function edit(Language $language)
    {
        return view('languages::edit')->with('language', $language);
    }

	/**
	 * Update the specified resource in storage.
	 * @param LanguagesRequest $request
	 * @param Language $language
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function update(LanguagesRequest $request, Language $language)
    {
    	$request->validated();

    	$language->code = Input::get('code');
    	$language->name = Input::get('name');
    	$language->native_name = Input::get('native_name');

		if (Input::get('actif') === null){
			$language->actif = 0;
		} else {
			$language->actif = 1;
		}

    	$language->save();

		Session::flash('message', 'Vous avez bien édité le langage !');
		return Redirect::route('languages.index');
    }

	/**
	 * Remove the specified resource from storage.
	 * @param Language $language
	 * @return int
	 * @throws \Exception
	 */
    public function destroy(Language $language)
    {
		if ($language->delete()) {
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
		$languages = Language::select(['id','name','code','native_name','actif']);

		return Datatables::of($languages)
			->addColumn('action', function ($languages) {
				return
					"<a href=\"" . route('languages.edit', $languages->id) . "\" class=\"m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill\" title=\"Editer\">
						<i class=\"la la-edit\"></i>
					</a>"
					."<button class=\"m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill\" id=\"" . $languages->id . "\" title=\"Supprimer\" data-action=\"delete\">
						<i class=\"la la-trash\"></i>
					</button>";
			})
			//->removeColumn('password')
			->make(true);
	}

	/**
	 * @param Language $language
	 * @return int|mixed
	 */
	public function enable (Language $language)
	{
		$language->actif = 1;
		if ($language->save()) {
			return 1;
		} else {
			return 0;
		}
	}

	/**
	 * @param Language $language
	 * @return int|mixed
	 */
	public function disable (Language $language)
	{
		$language->actif = 0;
		if ($language->save()) {
			return 1;
		} else {
			return 0;
		}
	}
}
