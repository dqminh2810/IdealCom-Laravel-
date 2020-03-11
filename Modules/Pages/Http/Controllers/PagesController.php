<?php

namespace Modules\Pages\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Modules\Core\Http\Controllers\ControllerCore;
use Modules\Pages\Entities\Page;
use Modules\Pages\Http\Requests\PagesRequest;
use Yajra\DataTables\DataTables;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
			return view('pages::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('pages::create');
    }

		/**
		 * Store a newly created resource in storage.
		 * @param PagesRequest $request
		 * @return \Illuminate\Http\RedirectResponse
		 */
    public function store(PagesRequest $request)
    {
    	$request->validated();

    	$page = new Page();
    	$page->title = Input::get('title');
    	$page->url = Input::get('url');
    	$page->code = Input::get('code');;
			if(Input::get('actif') === null){
				$page->actif = 0;
			} else {
				$page->actif = 1;
			}

			$page->save();

			Session::flash('message', 'Vous avez bien créé une nouvelle page de contenu !');
			return Redirect::route('pages.index');
    }

		/**
		 * Show the specified resource.
		 * @param Page $page
		 * @return Response
		 */
    public function show(Page $page)
    {
        //return view('pages::show')->with('page', $page);
        return $page->code;
    }

		/**
		 * Show the form for editing the specified resource.
		 * @param Page $page
		 * @return Response
		 */
    public function edit(Page $page)
    {
        return view('pages::edit')->with('page', $page);
    }

	/**
	 * Update the specified resource in storage.
	 * @param PagesRequest $request
	 * @param Page $page
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function update(PagesRequest $request, Page $page)
    {
			$request->validated();

			$page->title = Input::get('title');
			$page->url = Input::get('url');
			$page->code = Input::get('code');;
			if(Input::get('actif') === null){
				$page->actif = 0;
			} else {
				$page->actif = 1;
			}

			$page->save();

			Session::flash('message', 'Vous avez bien édité la page de contenu !');
			return Redirect::route('pages.index');
    }

	/**
	 * Remove the specified resource from storage.
	 * @param Page $page
	 * @return bool
	 * @throws \Exception
	 */
    public function destroy(Page $page)
    {
			if ($page->delete()) {
				return 'true';
			} else {
				return 'false';
			}
    }

		/**
		 * @return Json
		 * @throws \Exception
		 */
		public function getBasicData()
		{
			$pages = Page::select(['id','title','url','actif','created_at','updated_at']);

			return Datatables::of($pages)
				->addColumn('action', function ($pages) {
					return
						"<a href=\"" . route('pages.show', $pages->id) . "\" class=\"m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill\" title=\"Prévisualiser\">
						<i class=\"la la-eye\"></i>
					</a>"
						."<a href=\"" . route('pages.edit', $pages->id) . "\" class=\"m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill\" title=\"Editer\">
						<i class=\"la la-edit\"></i>
					</a>"
						."<button class=\"m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill\" id=\"" . $pages->id . "\" title=\"Supprimer\" data-action=\"delete\">
						<i class=\"la la-trash\"></i>
					</button>";
				})
				//->removeColumn('password')
				->make(true);
		}

		/**
		 * @param Page $page
		 * @return int|mixed
		 */
		public function enable (Page $page)
		{
			$page->actif = 1;
			$page->save();

			return $page->actif;
		}

		/**
		 * @param Page $page
		 * @return int|mixed
		 */
		public function disable (Page $page)
		{
			$page->actif = 0;
			$page->save();

			return $page->actif;
		}
}
