<?php

namespace Modules\Users\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\User;
use Modules\Users\Http\Requests\UsersRequest;
use Yajra\DataTables\DataTables;

class UsersController extends Controller
{
	/**
	 * Display a listing of the resource.
	 * @return Response
	 */
    public function index()
    {
    	return view('users::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('users::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UsersRequest $request)
    {
		$request->validated();

		$user = new User;
		$user->name = Input::get('name');
		$user->email = Input::get('email');
		$user->password = bcrypt(Input::get('password'));
		if(Input::get('actif') === null){
			$user->actif = 0;
		} else {
			$user->actif = 1;
		}
		
		$user->save();

		if (Auth::user()->can('admin-users-roles')) {
			if (Input::get('roles') != null) {
				foreach (Input::get('roles') as $key => $role) {
					$user->attachRole(Role::where('name', $role)->first());
				}
			}
		}
		$user->save();


		Session::flash('message', 'Vous avez bien créé un nouveau utilisateur !');
		return Redirect::route('users.index');
    }

	/**
	 * Show the specified resource.
	 * @param User $user
	 * @return Response
	 */
    public function show(User $user)
    {
        return view('users::show')->with('user', $user);
    }

	/**
	 * Show the form for editing the specified resource.
	 * @param User $user
	 * @return Response
	 */
    public function edit(User $user)
    {
        return view('users::edit')->with('user', $user);
    }

	/**
	 * Update the specified resource in storage.
	 * @param UsersRequest $request
	 * @param User $user
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function update(UsersRequest $request, User $user)
    {
		$request->validated();

		$user->name = Input::get('name');
		$user->email = Input::get('email');
		if(!(Input::get('password') === null)) {
			$user->password = bcrypt(Input::get('password'));
		}
		if(Input::get('actif') === null){
			$user->actif = 0;
		} else {
			$user->actif = 1;
		}
		$user->save();

		if (Auth::user()->can('admin-users-roles')) {
			// On supprime toutes les rôles lié à l'utilisateur
			if ($user->roles()->get() != null) {
				foreach ($user->roles()->get() as $roles => $role) {
					$user->detachRole($role->name);
				}
			}

			// Pour les recréer derrière (pour ne pas avoir de doublons et supprimer les rôles désélectionnées
			if (Input::get('roles') != null) {
				foreach (Input::get('roles') as $key => $role) {
					$user->attachRole(Role::where('name', $role)->first());
				}
			}
		}

		Session::flash('message', 'L\'utilisateur a bien été modifié !');
		return Redirect::route('users.index');

		}

	/**
	 * Remove the specified resource from storage.
	 * @param User $user
	 * @return bool
	 * @throws \Exception
	 */
    public function destroy(User $user)
    {
			if ($user->delete()) {
				return 'true';
			} else {
				return 'false';
			}
    }

	/**
	 * @return mixed
	 * @throws \Exception
	 */
	public function getBasicData()
	{
		$users = User::select(['id','name','email','actif','created_at','updated_at']);

		return Datatables::of($users)
			->addColumn('action', function ($users) {
				return
					"<a href=\"" . route('users.edit', $users->id) . "\" class=\"m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill\" title=\"Editer\">
						<i class=\"la la-edit\"></i>
					</a>"
					."<button class=\"m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill\" id=\"" . $users->id . "\" title=\"Supprimer\" data-action=\"delete\">
						<i class=\"la la-trash\"></i>
					</button>";
			})
			//->removeColumn('password')
			->make(true);
	}

	public function enable (User $user)
	{
		$user->actif = 1;
		$user->save();

		return $user->actif;
	}
	public function disable (User $user)
	{
		$user->actif = 0;
		$user->save();

		return $user->actif;
	}
}
