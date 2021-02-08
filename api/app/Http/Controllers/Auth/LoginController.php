<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Customer;
use App\Models\Company;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Str;
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
    protected $redirectTo = "/home";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        // Attempt to login
        if (!auth()->attempt($request->only('email', 'password'), $request->get('remember_token', false))) {
            return redirect('/auth/login')->withInput($request->input())->withErrors(["status" => "帳號密碼驗證錯誤"]);
        }

        return redirect('/');
    }

    public function logout(Request $request)
    {
        auth()->logout();
        return redirect('/');
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
    public function facebookCallback(Request $request, UserService $service)
    {
        $user = Socialite::driver('facebook')->user();
        $login_user = $service->getOrCreate($user, 'facebook');
        $token = auth()->login($login_user, true);

        return redirect('/');
    }

    /**
     * google
     *
     * @return \Illuminate\Http\Response
     */
    public function google(Request $request)
    {
        $query_str = base64_encode(json_encode($request->query()));

        return Socialite::driver('google')->with(['state' => $query_str])->redirect();
    }

    /**
     * Obtain the user information from google.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function googleCallback(Request $request, UserService $service)
    {
        $google_user = Socialite::driver('google')->stateless()->user();

        $params = json_decode(base64_decode($request->state), true);

        $type = $params['type'] ?? 'user';


        if ($type == 'user') {
            $login_user = $service->getOrCreate($google_user, 'google');

            auth()->login($login_user, true);
            return redirect('/home');
        }

        if ($type == 'customer') {
            $company = Company::where('en_name', $params['id'])->first();

            $customer = Customer::create([
                'uuid' => Str::random(18),
                'user_id' => $company->owner_id,
                'name' => $google_user->name ?? explode('@', $google_user->email)[0],
                'email' => $google_user->email,
                'avatar' => $google_user->avatar ?? config('user.default_avatar'),
                'password' => '',
                'phone' => '',
                'identify_id' => $google_user->id,
                'identify_provider' => 'google',
                'birth' => null,
            ]);

            return redirect("/company/{$company->en_name}/register?uuid={$customer->uuid}");
        }
        return redirect('/home');
    }
}
