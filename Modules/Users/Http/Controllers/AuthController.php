<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Middleware\Actif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Support\MessageBag;


class AuthController extends LoginController
{
	/**
	 * @return string
	 */
	protected function redirectTo()
	{
		if (Auth::user()->can('admin-dashboard'))
		{
			return route('admin.dashboard');
		}
		else
		{
            return redirect('admin/login')->with('status', 'Veuillez prendre contact avec un administrateur !'.
                '\n Votre compte est inactif pour le moment.');
		}
	}

    /**
     * The user has been authenticated.
     *
     * @override
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->actif == 0) {
            auth()->logout();
            return back()->with('status', __('auth.status'));
        }
        return redirect()->route('admin.dashboard');
    }

    /**
     * Handle a login request to the application.
     * @override
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }else {
            $errors = new MessageBag(['errorlogin' => __('auth.failed')]);
            return redirect()->back()->withErrors($errors);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }


	/**
	 * @return Response
	 */
	public function showLoginForm()
	{
		return view('users::auth.login');
	}

}



