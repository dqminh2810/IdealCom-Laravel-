<?php

namespace Modules\Menus\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Modules\Menus\Entities\Menu;
use Modules\Menus\Entities\MenuItem;
use Modules\Menus\Http\Requests\MenuItemsRequest;
use Yajra\DataTables\DataTables;

class MenuItemsController extends Controller
{
	/**
	 * Show the form for creating a new resource.
	 * @return Response
	 */
	public function create(Menu $menu, $menuitem)
	{
		if (MenuItem::find($menuitem))
		{
			$menuitem = MenuItem::find($menuitem);
		}
		else
		{
			$menuitem = 0;
		}

		return view('menus::menuitems.create')
			->with('menu', $menu)
			->with('menuitem', $menuitem);
	}

	/**
	 * Store a newly created resource in storage.
	 * @param MenuItemsRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(MenuItemsRequest $request)
	{
		$request->validated();

		$menuitem = new MenuItem();
		$menuitem->name = Input::get('name');
		$menuitem->display_name = Input::get('display_name');
		$menuitem->menu_id = Input::get('menu_id');
		$menuitem->hidden = Input::get('hidden');
		$menuitem->readonly = Input::get('readonly');

		if (Input::get('url') != null){
			$menuitem->url = Input::get('url');
		}

		$menuitem->target = Input::get('target');

		if (Input::get('actif') === null){
			$menuitem->actif = 0;
		} else {
			$menuitem->actif = 1;
		}

		if (Input::get('parent_id') > 0)
		{
			$parent = MenuItem::find(Input::get('parent_id'));
			MenuItemsController::addSpace($parent);
			$parent->right += 2;
			$parent->save();

			$menuitem->parent_id = $parent->id;
			//$menuitem->arbre_id = $parent->arbre_id;
			$menuitem->left = $parent->right - 2;
			$menuitem->right = $parent->right - 1;
			$menuitem->level = $parent->level + 1;
			$menuitem->save();
		}
		else
		{
			$last_menuitem = MenuItem::where('menu_id', Input::get('menu_id'))->orderBy('right', 'desc')->first();

			$menuitem->left = $last_menuitem + 1;
			$menuitem->right = $last_menuitem + 2;
			$menuitem->level = 1;
			$menuitem->save();
			//$menuitem->arbre_id = $menuitem->id;
			//$menuitem->save();

		}

		Session::flash('message', 'Vous avez bien créé un nouveau menuitem !');
		return Redirect::route('menuitems.show', Input::get('menu_id'));
	}

	/**
	 * Show the specified resource.
	 * @param Menu $menu
	 * @return Response
	 */
	public function show(Menu $menu)
	{
		return view('menus::menuitems.show')->with('menu', $menu);
	}

	/**
	 * Show the form for editing the specified resource.
	 * @param MenuItem $menuitem
	 * @return Response
	 */
	public function edit(MenuItem $menuitem)
	{
		return view('menus::menuitems.edit')->with('menuitem', $menuitem);
	}

	/**
	 * Update the specified resource in storage.
	 * @param MenuItemsRequest $request
	 * @param MenuItem $menuitem
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(MenuItemsRequest $request, MenuItem $menuitem)
	{
		$request->validated();

		$menuitem->title = Input::get('title');
		$menuitem->position = Input::get('position');
		$menuitem->banner_color = Input::get('banner_color');
		$menuitem->banner_text = Input::get('banner_text');
		$menuitem->banner_text_color = Input::get('banner_text_color');
		$menuitem->button_color = Input::get('button_color');
		$menuitem->button_text = Input::get('button_text');
		$menuitem->button_text_color = Input::get('button_text_color');
		$menuitem->link = Input::get('link');

		if (Input::get('actif') === null){
			$menuitem->actif = 0;
		} else {
			$menuitem->actif = 1;
		}

		$menuitem->save();


		Session::flash('message', 'Vous avez bien édité le menuitem !');
		return Redirect::route('menuitems.index');
	}

	/**
	 * Remove the specified resource from storage.
	 * @param MenuItem $menuitem
	 * @return int
	 * @throws \Exception
	 */
	public function destroy(MenuItem $menuitem)
	{
		$diff = $menuitem->right - $menuitem->left;
		if ($diff == 1) {
			if ($menuitem->parent_id != NULL)
			{
				MenuItemsController::removeSpace($menuitem);
			}

			if ($menuitem->delete()) {
				return 1;
			} else {
				return 0;
			}
		}
		else
		{

		}
		return 0;
	}

	/**
	 * @return mixed
	 * @throws \Exception
	 */
	public function getBasicData(Menu $menu)
	{
		$menuitems = $menu->menuitems;

		return Datatables::of($menuitems)
			->addColumn('action', function ($menuitems) use ($menu) {
				if ($menuitems->level < 4)
				{
					if (($menuitems->right - $menuitems->left) == 1) {
						return
							"<a href=\"" . route('menuitems.create', ['menu' => $menu->id, 'menuitem' => $menuitems->id]) . "\" class=\"m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill\" title=\"Créer un sous-menuitem\">
							<i class=\"la la-plus\"></i>
						</a>"
							. "<a href=\"" . route('menuitems.show', $menuitems->id) . "\" class=\"m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill\" title=\"Prévisualiser\">
							<i class=\"la la-eye\"></i>
						</a>"
							. "<a href=\"" . route('menuitems.edit', $menuitems->id) . "\" class=\"m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill\" title=\"Editer\">
							<i class=\"la la-edit\"></i>
						</a>"
							. "<button class=\"m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill\" id=\"" . $menuitems->id . "\" title=\"Supprimer\" data-action=\"delete\">
							<i class=\"la la-trash\"></i>
						</button>";
					}
					else
					{
						return
							"<a href=\"" . route('menuitems.create', ['menu' => $menu->id, 'menuitem' => $menuitems->id]) . "\" class=\"m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill\" title=\"Créer un sous-menuitem\">
							<i class=\"la la-plus\"></i>
						</a>"
							. "<a href=\"" . route('menuitems.show', $menuitems->id) . "\" class=\"m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill\" title=\"Prévisualiser\">
							<i class=\"la la-eye\"></i>
						</a>"
							. "<a href=\"" . route('menuitems.edit', $menuitems->id) . "\" class=\"m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill\" title=\"Editer\">
							<i class=\"la la-edit\"></i>
						</a>";
					}
				}
				else
				{
					return
						"<a href=\"" . route('menuitems.show', $menuitems->id) . "\" class=\"m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill\" title=\"Prévisualiser\">
							<i class=\"la la-eye\"></i>
						</a>"
						."<a href=\"" . route('menuitems.edit', $menuitems->id) . "\" class=\"m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill\" title=\"Editer\">
							<i class=\"la la-edit\"></i>
						</a>"
						."<button class=\"m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill\" id=\"" . $menuitems->id . "\" title=\"Supprimer\" data-action=\"delete\">
							<i class=\"la la-trash\"></i>
						</button>";
				}
			})
			//->removeColumn('password')
			->make(true);
	}

	/**
	 * @param MenuItem $menuitem
	 * @return int|mixed
	 */
	public function enable (MenuItem $menuitem)
	{
		$menuitem->actif = 1;
		if ($menuitem->save()) {
			return 1;
		} else {
			return 0;
		}
	}

	/**
	 * @param MenuItem $menuitem
	 * @return int|mixed
	 */
	public function disable (MenuItem $menuitem)
	{
		$menuitem->actif = 0;
		if ($menuitem->save()) {
			return 1;
		} else {
			return 0;
		}
	}

	public static function addSpace(MenuItem $menuitem)
	{
		$hierarchies = $menuitem->hierarchies();

		foreach ($hierarchies as $key=>$hierarchie)
		{
			$hierarchie->right += 2;
			$hierarchie->save();
		}
		return $hierarchies;
	}

	public static function removeSpace(MenuItem $menuitem, int $nombre = 2)
	{
		$hierarchies_left = $menuitem->sameArbre()->where('left', '>=', $menuitem->left);
		$hierarchies_right = $menuitem->sameArbre()->where('right', '>=', $menuitem->left);

		foreach ($hierarchies_left as $key=>$hierarchie)
		{
			$hierarchie->left -= $nombre;
			$hierarchie->save();
		}

		foreach ($hierarchies_right as $key=>$hierarchie)
		{
			$hierarchie->right -= $nombre;
			$hierarchie->save();
		}

		return ['hierarchies_left'=>$hierarchies_left, 'hierarchies_right'=>$hierarchies_right];
	}

}
