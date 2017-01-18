<?php

namespace Skill\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Skill\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

	/**
	 * Create a new controller instance.
	 *
	 */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }


	public function username()
	{
		return 'matricula';
	}


	/**
	 * Attempt to log the user into the application.
	 *
	 * @param \Illuminate\Http\Request|Request $request
	 *
	 * @return bool
	 */
	protected function attemptLogin(Request $request)
	{
		return $this->guard()->attempt(
			['matricula' =>  $request->matricula, 'password' => $request->password, 'active' => 1], $request->has('remember')
		);
	}
}
