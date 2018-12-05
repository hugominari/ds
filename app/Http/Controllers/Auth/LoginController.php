<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;

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
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
	
	/**
	 * Check either username or email.
	 * @return string
	 */
	public function username()
	{
		return request()->get('username');
	}
	
	/**
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 * @throws ValidationException
	 */
	public function login(Request $request)
	{
		self::validateLogin($request);
		$attempt = Auth::attempt([
			'username' => $request->username,
			'password' => $request->password
		]);
		
		if($attempt)
		{
			$user = auth()->user();
			$response = $this->createResult();
			
			if($request->ajax())
			{
				$response->success = true;
				$response->type = 'success';
				$response->time = 1000;
				$response->message = 'Logando...';
				$response->callback = 'redirect';
				$response->url = route('dashboard');
				$response->auth = auth()->check();
				$response->intended = route('dashboard');
				
				return Response::json($response);
			}
			
			return redirect()->intended(route('dashboard'));
		}
		
		return $this->sendFailedLoginResponse($request);
	}
	
	/**
	 * Validate the user login.
	 * @param Request $request
	 */
	protected function validateLogin(Request $request)
	{
		$this->validate(
			$request,
			[
				'username' => 'required|string',
				'password' => 'required|string',
			],
			[
				'username.required' => 'Usuário inválido',
				'password.required' => 'Senha inválida',
			]
		);
	}
	
	// /**
	//  * @param Request $request
	//  * @throws ValidationException
	//  */
	// protected function sendFailedLoginResponse(Request $request)
	// {
	// 	$request->session()->put('login_error', trans('auth.failed'));
	//
	// 	throw ValidationException::withMessages(
	// 		[
	// 			'error' => [trans('auth.failed')],
	// 		]
	// 	);
	// }
	
	/**
	 * Method override to send correct error messages
	 * Get the failed login response instance.
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	protected function sendFailedLoginResponse(Request $request)
	{
		$response = $this->createResult();
		$response->success = true;
		
		$user = User::where('username', '=', $request->username)->first();
		
		if($user)
		{
			if(!Hash::check($request->password, $user->password))
			{
				$response->type         = 'error';
				$response->message      = 'Credenciais de acesso incorretos!';
			}
		}
		else
		{
			$response->type         = 'error';
			$response->message      = 'Credenciais de acesso incorretos!';
		}
		
		return Response::json($response);
	}
	
	/**
	 * Log the user out of the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function logout(Request $request)
	{
		$request->session()->invalidate();
		Auth::logout();
		
		return redirect('/login');
	}
}
