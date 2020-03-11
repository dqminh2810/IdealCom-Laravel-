<?php

namespace Modules\Roles\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Modules\Roles\Http\Requests\RolesRequest;
use Psy\Util\Json;
use Yajra\DataTables\DataTables;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
      return view('roles::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('roles::create');
    }

	/**
	 * Store a newly created resource in storage.
	 * @param RolesRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function store(RolesRequest $request)
    {
			$request->validated();

			$role = new Role;
			$role->name = strtolower(Input::get('name'));
			$role->display_name = Input::get('display_name');
			$role->description = Input::get('description');
			if(Input::get('actif') === null){
				$role->actif = 0;
			} else {
				$role->actif = 1;
			}

			$role->save();

			if (Input::get('permissions') != null) {
				foreach (Input::get('permissions') as $key => $perm) {
					$role->attachPermission(Permission::where('name', $perm)->first());
				}
			}

			Session::flash('message', 'Vous avez bien créé un nouveau rôle !');
			return Redirect::route('roles.index');
    }

	/**
	 * Show the specified resource.
	 * @param Role $role
	 * @return Response
	 */
    public function show(Role $role)
    {
        return view('roles::show')->with('role', $role);
    }

	/**
	 * Show the form for editing the specified resource.
	 * @param Role $role
	 * @return Response
	 */
    public function edit(Role $role)
    {
        return view('roles::edit')->with('role', $role);
    }

	/**
	 * Update the specified resource in storage.
	 * @param RolesRequest $request
	 * @param Role $role
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function update(RolesRequest $request, Role $role)
    {

			$request->validated();

			$role->name = strtolower(Input::get('name'));
			$role->display_name = Input::get('display_name');
			$role->description = Input::get('description');
			if(Input::get('actif') === null){
				$role->actif = 0;
			} else {
				$role->actif = 1;
			}

			$role->save();

			// On supprime toutes les permissions lié au rôle
			if ($role->permissions()->get() != null) {
				foreach ($role->permissions()->get() as $permissions=>$permission){
					$role->detachPermission($permission->name);
				}
			}
			//dd($role->permissions()->get());

			// Pour les recréer derrière (pour ne pas avoir de doublons et supprimer les permissions désélectionnées
			if (Input::get('permissions') != null) {
				foreach (Input::get('permissions') as $key => $value) {
					$role->attachPermission(Permission::where('name', $value)->first());
				}
			}

			Session::flash('message', 'Le rôle a bien été édité !');
			return Redirect::route('roles.index');
    }

	/**
	 * Remove the specified resource from storage.
	 * @param Role $role
	 * @return bool
	 * @throws \Exception
	 */
    public function destroy(Role $role)
    {
			if ($role->delete()) {
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
			$roles = Role::select(['id','name','display_name','description','actif','created_at','updated_at']);

			return Datatables::of($roles)
				->addColumn('action', function ($roles) {
					return
						"<a href=\"" . route('roles.show', $roles->id) . "\" class=\"m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill\" title=\"Prévisualiser\">
						<i class=\"la la-eye\"></i>
					</a>"
						."<a href=\"" . route('roles.edit', $roles->id) . "\" class=\"m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill\" title=\"Editer\">
						<i class=\"la la-edit\"></i>
					</a>"
						."<button class=\"m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill\" id=\"" . $roles->id . "\" title=\"Supprimer\" data-action=\"delete\">
						<i class=\"la la-trash\"></i>
					</button>";
				})
				//->removeColumn('password')
				->make(true);
		}

	/**
	 * @param Role $role
	 * @return int|mixed
	 */
	public function enable (Role $role)
		{
			$role->actif = 1;
			$role->save();

			return $role->actif;
		}

	/**
	 * @param Role $role
	 * @return int|mixed
	 */
	public function disable (Role $role)
		{
			$role->actif = 0;
			$role->save();

			return $role->actif;
		}
}
