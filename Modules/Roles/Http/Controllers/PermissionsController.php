<?php

namespace Modules\Roles\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Modules\Roles\Http\Requests\PermissionsRequest;
use Yajra\DataTables\DataTables;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('roles::permissions.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('roles::permissions.create');
    }

	/**
	 * Store a newly created resource in storage.
	 * @param PermissionsRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function store(PermissionsRequest $request)
		{
			$request->validated();

			$permission = new Permission();
			$permission->name = strtolower(Input::get('name'));
			$permission->display_name = Input::get('display_name');
			$permission->description = Input::get('description');
			if(Input::get('actif') === null){
				$permission->actif = 0;
			} else {
				$permission->actif = 1;
			}

			$permission->save();
			Session::flash('message', 'Vous avez bien créé une nouvelle permission !');
			return Redirect::route('permissions.index');
		}

	/**
	 * Show the form for editing the specified resource.
	 * @param Permission $permission
	 * @return Response
	 */
    public function edit(Permission $permission)
    {
        return view('roles::permissions.edit')->with('permission',$permission);
    }

	/**
	 * Update the specified resource in storage.
	 * @param PermissionsRequest $request
	 * @param Permission $permission
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function update(PermissionsRequest $request, Permission $permission)
    {
			$request->validated();

			$permission->name = strtolower(Input::get('name'));
			$permission->display_name = Input::get('display_name');
			$permission->description = Input::get('description');
			if(Input::get('actif') === null){
				$permission->actif = 0;
			} else {
				$permission->actif = 1;
			}

			$permission->save();
			Session::flash('message', 'La permission a bien été éditée !');
			return Redirect::route('permissions.index');
    }

	/**
	 * Remove the specified resource from storage.
	 * @param Permission $permission
	 * @return bool
	 * @throws \Exception
	 */
    public function destroy(Permission $permission)
    {
			if ($permission->delete()) {
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
			$permissions = Permission::select(['id','name','display_name','description','actif','created_at','updated_at']);

			return Datatables::of($permissions)
				->addColumn('action', function ($permissions) {
					return
						"<a href=\"" . route('permissions.edit', $permissions->id) . "\" class=\"m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill\" title=\"Editer\">
							<i class=\"la la-edit\"></i>
						</a>"
							."<button class=\"m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill\" id=\"" . $permissions->id . "\" title=\"Supprimer\" data-action=\"delete\">
							<i class=\"la la-trash\"></i>
						</button>";
				})
				//->removeColumn('password')
				->make(true);
		}

	/**
	 * @param Permission $permission
	 * @return int|mixed
	 */
		public function enable (Permission $permission)
		{
			$permission->actif = 1;
			$permission->save();

			return $permission->actif;
		}

	/**
	 * @param Permission $permission
	 * @return int|mixed
	 */
		public function disable (Permission $permission)
		{
			$permission->actif = 0;
			$permission->save();

			return $permission->actif;
		}
}

