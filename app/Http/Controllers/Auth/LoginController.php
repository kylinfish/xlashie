<?php

namespace App\Http\Controllers\Auth;

use Laravel\Socialite\Facades\Socialite;
use Laravel\Lumen\Routing\Controller as BaseController;

class LoginController extends BaseController
{
    /**
     * facebook redirect the user to the facebook authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function facebook()
    {
        return Socialite::with('facebook')->stateless()->redirect();
    }

    /**
     * facebookCallback
     *
     * @return \Illuminate\Http\Response
     */
    public function facebookCallback()
    {
        $user = Socialite::driver('facebook')->stateless()->user();
    }
}
