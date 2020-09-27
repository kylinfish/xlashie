<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\DiscountRepositoy;
use App\Models\Company;
use App\Models\Customer;
use Socialite;

class CompanyController extends \App\Http\Controllers\Controller
{
    public function landing(Request $request, string $en_name)
    {
        if (!$company = Company::where('en_name', $en_name)->first()) {

        }

        return view('companies.landing', compact('company'));
    }

    public function register(Request $request, string $en_name)
    {
        if (!$company = Company::where('en_name', $en_name)->first()) {
        }

        return view('companies.register', compact('company'));
    }

    public function done(Request $request, string $en_name)
    {
        if (!$company = Company::where('en_name', $en_name)->first()) {
        }

        return view('companies.done', compact('company'));
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
    public function google($en_name)
    {
        session(['company_id' => $en_name]);
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
        dd(session('company_id'));
        $auth_user = Socialite::driver('google')->user();
        if (empty($auth_user->email)) {
            throw new InvalidArgumentException('使帳號缺乏帳戶辨識使用的 Eamil');
        }

        $customer = Customer::create([
            'uuid' => Str::random(18),
            'name' => $auth_user->name ?? explode('@', $auth_user->email)[0],
            'email' => $auth_user->email,
            'avatar' => $auth_user->avatar ?? config('user.default_avatar'),
            'password' => '',
            'phone' => '',
            'company_id' => $request->c_id,
            'identify_id' => $auth_user->id,
            'identify_provider' => 'google',
            'birth' => null,
        ]);

        return redirect()->route("companies/{$request->c_id}/register/", ['uuid' => $customer->uuid]);
    }
}
