<?php

namespace Modules\Menus\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Modules\Menus\Entities\Menu;
use Modules\Menus\Http\Requests\MenusRequest;
use Yajra\DataTables\DataTables;

class MenusController extends Controller
{
	/**
	 * Display a listing of the resource.
	 * @return Response
	 */
	public function index()
	{
		return view('menus::index');
	}

	/**
	 * Show the form for creating a new resource.
	 * @return Response
	 */
	public function create()
	{
		return view('menus::create');
	}

	/**
	 * Store a newly created resource in storage.
	 * @param MenusRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(MenusRequest $request)
	{
		$request->validated();

		$menu = new Menu();
		$menu->name = strtoupper(Input::get('name'));
		$menu->display_name = Input::get('display_name');
		$menu->home = Input::get('home');
		$menu->actif = Input::get('actif');

		$last = Menu::orderBy('position', 'desc')->first();
		if ($last != null)
		{
			$menu->position = $last->position + 1;
		}
		else
		{
			$menu->position = 0;
		}

		if (Input::get('actif') === null){
			$menu->actif = 0;
		} else {
			$menu->actif = 1;
		}

		$menu->save();


		Session::flash('message', 'Vous avez bien créé un nouveau menu !');
		return Redirect::route('menus.index');
	}

	/**
	 * Show the specified resource.
	 * @param Menu $menu
	 * @return Response
	 */
	public function show(Menu $menu)
	{
		return view('menus::show')->with('menu', $menu);
	}

	/**
	 * Show the form for editing the specified resource.
	 * @param Menu $menu
	 * @return Response
	 */
	public function edit(Menu $menu)
	{
		return view('menus::edit')->with('menu', $menu);
	}

	/**
	 * Update the specified resource in storage.
	 * @param MenusRequest $request
	 * @param Menu $menu
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(MenusRequest $request, Menu $menu)
	{
		$request->validated();

		$menu->name = strtoupper(Input::get('name'));
		$menu->display_name = Input::get('display_name');
		$menu->home = Input::get('home');
		$menu->actif = Input::get('actif');

		if (Input::get('actif') === null){
			$menu->actif = 0;
		} else {
			$menu->actif = 1;
		}

		$menu->save();


		Session::flash('message', 'Vous avez bien édité le menu !');
		return Redirect::route('menus.index');
	}

	/**
	 * Remove the specified resource from storage.
	 * @param Menu $menu
	 * @return int
	 * @throws \Exception
	 */
	public function destroy(Menu $menu)
	{
		if ($menu->delete()) {
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
		$menus = Menu::select(['id','name','display_name','position','home','actif','created_at','updated_at']);

		return Datatables::of($menus)
			->addColumn('action', function ($menus) {
				return
					link_to_route('menuitems.show', 'MenuItems', array('menu'=>$menus->id), array('class'=>'btn btn-small btn-brand'))."	"
					."<a href=\"" . route('menus.edit', $menus->id) . "\" class=\"m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill\" title=\"Editer\">
						<i class=\"la la-edit\"></i>
					</a>"
					."<button class=\"m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill\" id=\"" . $menus->id . "\" title=\"Supprimer\" data-action=\"delete\">
						<i class=\"la la-trash\"></i>
					</button>";
			})
			//->removeColumn('password')
			->make(true);
	}

	/**
	 * @param Menu $menu
	 * @return int|mixed
	 */
	public function enable (Menu $menu)
	{
		$menu->actif = 1;
		if ($menu->save()) {
			return 1;
		} else {
			return 0;
		}
	}

	/**
	 * @param Menu $menu
	 * @return int|mixed
	 */
	public function disable (Menu $menu)
	{
		$menu->actif = 0;
		if ($menu->save()) {
			return 1;
		} else {
			return 0;
		}
	}

}
