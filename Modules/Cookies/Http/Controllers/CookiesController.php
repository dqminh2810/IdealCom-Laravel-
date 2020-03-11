<?php

namespace Modules\Cookies\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Modules\Cookies\Entities\Cookie;
use Modules\Cookies\Http\Requests\CookiesRequest;
use Yajra\DataTables\DataTables;

class CookiesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('cookies::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('cookies::create');
    }

		/**
		 * Store a newly created resource in storage.
		 * @param CookiesRequest $request
		 * @return \Illuminate\Http\RedirectResponse
		 */
    public function store(CookiesRequest $request)
    {
			$request->validated();

			$cookie = new Cookie();
			$cookie->title = Input::get('title');
			$cookie->position = Input::get('position');
			$cookie->banner_color = Input::get('banner_color');
			$cookie->banner_text = Input::get('banner_text');
			$cookie->banner_text_color = Input::get('banner_text_color');
			$cookie->button_color = Input::get('button_color');
			$cookie->button_text = Input::get('button_text');
			$cookie->button_text_color = Input::get('button_text_color');
			$cookie->link = Input::get('link');

			if (Input::get('actif') === null){
				$cookie->actif = 0;
			} else {
				$cookie->actif = 1;
			}

    	$cookie->save();


			Session::flash('message', 'Vous avez bien créé un nouveau modèle !');
			return Redirect::route('cookies.index');
    }

		/**
		 * Show the specified resource.
		 * @param Cookie $cookie
		 * @return Response
		 */
    public function show(Cookie $cookie)
    {
        return view('cookies::show')->with('cookie', $cookie);
    }

		/**
		 * Show the form for editing the specified resource.
		 * @param Cookie $cookie
		 * @return Response
		 */
    public function edit(Cookie $cookie)
    {
        return view('cookies::edit')->with('cookie', $cookie);
    }

		/**
		 * Update the specified resource in storage.
		 * @param CookiesRequest $request
		 * @param Cookie $cookie
		 * @return \Illuminate\Http\RedirectResponse
		 */
    public function update(CookiesRequest $request, Cookie $cookie)
    {
			$request->validated();

			$cookie->title = Input::get('title');
			$cookie->position = Input::get('position');
			$cookie->banner_color = Input::get('banner_color');
			$cookie->banner_text = Input::get('banner_text');
			$cookie->banner_text_color = Input::get('banner_text_color');
			$cookie->button_color = Input::get('button_color');
			$cookie->button_text = Input::get('button_text');
			$cookie->button_text_color = Input::get('button_text_color');
			$cookie->link = Input::get('link');

			if (Input::get('actif') === null){
				$cookie->actif = 0;
			} else {
				$cookie->actif = 1;
			}

			$cookie->save();


			Session::flash('message', 'Vous avez bien édité le modèle !');
			return Redirect::route('cookies.index');
    }

	/**
	 * Remove the specified resource from storage.
	 * @param Cookie $cookie
	 * @return int
	 * @throws \Exception
	 */
    public function destroy(Cookie $cookie)
    {
			if ($cookie->delete()) {
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
		$cookies = Cookie::select(['id','title','actif','created_at','updated_at']);

		return Datatables::of($cookies)
			->addColumn('action', function ($cookies) {
				return
					"<a href=\"" . route('cookies.show', $cookies->id) . "\" class=\"m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill\" title=\"Prévisualiser\">
						<i class=\"la la-eye\"></i>
					</a>"
					."<a href=\"" . route('cookies.edit', $cookies->id) . "\" class=\"m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill\" title=\"Editer\">
						<i class=\"la la-edit\"></i>
					</a>"
					."<button class=\"m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill\" id=\"" . $cookies->id . "\" title=\"Supprimer\" data-action=\"delete\">
						<i class=\"la la-trash\"></i>
					</button>";
			})
			//->removeColumn('password')
			->make(true);
	}

	/**
	 * @param Cookie $cookie
	 * @return int|mixed
	 */
	public function enable (Cookie $cookie)
	{
		$cookie->actif = 1;
		if ($cookie->save()) {
			return 1;
		} else {
			return 0;
		}
	}

	/**
	 * @param Cookie $cookie
	 * @return int|mixed
	 */
	public function disable (Cookie $cookie)
	{
		$cookie->actif = 0;
		if ($cookie->save()) {
			return 1;
		} else {
			return 0;
		}
	}

}
