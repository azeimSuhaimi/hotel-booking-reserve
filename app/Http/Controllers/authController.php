<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Crypt;


use App\Models\user;

class authController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }// end method

    public function login(Request $request)
    {
        $remember = $request->input('remember_token ');

        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        if (Auth::attempt($validated, $remember)) 
        {
            //user::update_last_login($validated['email']);

            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->with('error','accout or password is wrong')->onlyInput('email');

    }//end method
}
