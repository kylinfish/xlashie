<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\DiscountRepositoy;
use App\Forms\CompanyForm;
use App\Models\Company;
use App\Models\Customer;
use Socialite;

class CompanyController extends \App\Http\Controllers\Controller
{
    public function show()
    {
        if ($company = user()->company or $company = Company::where('owner_id', user()->id)->first()) {
            return view('companies.show', compact('company'));
        }

        return redirect('/company/create');
    }

    public function create()
    {
        if (user()->company or Company::where('owner_id', user()->id)->first()) {
            return redirect('/')
            ->with(['alert' => 'warning', 'message' => '您已經擁有屬於自己的店家']);
        }
        return view('companies.create');
    }

    public function store(Request $request, CompanyForm $form)
    {
        $params = $request->only(['name', 'account', 'contact', 'description']);
        if ($errors = $form->validate($params)) {
            return redirect()->back()
            ->with(['alert' => 'warning', 'message' => '新增失敗'])
            ->withErrors($errors)
            ->withInput($request->all());
        }

        $company = Company::create([
            'owner_id' => user()->id,
            'name' => $params['name'],
            'account' => $params['account'],
            'contact' => $params['contact'] ?? '',
            'description' => $params['description'] ?? '',
        ]);

        return redirect('/menus/')->with(['alert' => 'success', 'message' => '新增成功，從新增你的 [服務項目] 開始吧']);
    }


    /* Ready for migrating to Customer/Folder */
    public function landing(Request $request, string $en_name)
    {
        if (!$company = Company::where('en_name', $en_name)->first()) {
        }

        return view('companies.landing', compact('company'));
    }


    public function register(Request $request, string $en_name)
    {
        if ($request->isMethod('post')) {
            $params = $request->only(["name", "cellphone", "email", "uuid", "birth"]);
            if ($customer = Customer::where('uuid', $params['uuid'])->first()) {
                $customer->update($params);
            }
            return redirect("/company/{$en_name}/done");
        }

        $company = Company::where('en_name', $en_name)->first();
        $customer = Customer::where('uuid', $request->uuid)->first();
        return view('companies.register', compact('company', 'customer'));
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
