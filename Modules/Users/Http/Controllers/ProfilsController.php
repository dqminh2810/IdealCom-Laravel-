<?php

namespace Modules\Users\Http\Controllers;

use App\User;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Modules\Users\Http\Requests\ProfilsRequest;

class ProfilsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('users::profil.index')->with('user', $user);
    }

	/**
	 * Update the specified resource in storage.
	 * @param ProfilsRequest $request
	 * @param User $user
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function update(ProfilsRequest $request, User $user)
    {
        $request->validated();

        if (Input::get('name') != NULL) {
			$user->name = Input::get('name');
		}
		if (Input::get('telephone') != NULL) {
			$user->telephone = Input::get('telephone');
		}
		if (Input::get('website') != NULL) {
			$user->website = Input::get('website');
		}
		if (Input::get('address') != NULL) {
			$user->address = Input::get('address');
		}
		if (Input::get('city') != NULL) {
			$user->city = Input::get('city');
		}
		if (Input::get('country') != NULL) {
			$user->country = Input::get('country');
		}
		if ($request->file('avatar') != NULL) {
			$avatar = $request->file('avatar');
			$avatar_path = $avatar->storeAs('avatar', $user->id);
			$user->avatar = $avatar_path;
		}

        $user->save();

        Session::flash('message', 'Votre profil a bien été modifié !');
        return Redirect::route('profils.index');
    }
}
