<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;

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
    protected $redirectTo = "/";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        // Attempt to login
        if (!auth()->attempt($request->only('email', 'password'), $request->get('remember_token', false))) {
            return redirect('/auth/login')->withInput($request->input())->withErrors(["status" => "帳號密碼驗證錯誤"]);
        }

        auth('api')->attempt($request->only('email', 'password'), $request->get('remember_token', false));

        return redirect('/');
    }

    public function logout(Request $request)
    {
        auth()->logout();
        return redirect('/auth/login/');
    }

    /**
     * Redirect the user to the facebook authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function facebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from facebook.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function facebookCallback(Request $request)
    {
        $user = Socialite::driver('facebook')->user();
        $login_user = $this->service->login($user, 'facebook');
        $token = auth()->login($login_user, true);

        $request->session()->put('access_token', $token);
        $request->session()->put('expires_in', auth()->factory()->getTTL() * 60);

        return redirect('user/dashboard');
    }

    /**
     * google
     *
     * @return \Illuminate\Http\Response
     */
    public function google()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from google.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function googleCallback(Request $request)
    {
        $user = Socialite::driver('google')->user();
        $login_user = $this->service->login($user, 'google');
        $token = auth()->login($login_user, true);

        $request->session()->put('access_token', $token);
        $request->session()->put('expires_in', auth()->factory()->getTTL() * 60);

        return redirect('user/dashboard');
    }
}
