<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends \App\Http\Controllers\Controller
{
    public function demo()
    {
        $is_demo = auth()->user()->is_demo;
        $new_mode = $is_demo ? 0 : 1;

        User::find(auth()->user()->id)->update(['is_demo' => $new_mode]);

        return redirect('/home');
    }
}
