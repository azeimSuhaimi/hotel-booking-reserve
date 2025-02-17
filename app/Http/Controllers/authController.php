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

    public function logout(Request $request)
    {
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();

        return redirect(route('auth.logout.page'));

    }// end method

    public function logout_page(Request $request)
    {
        return view('auth.logout');
    }// end method

    public function create(Request $request)
    {
        return view('auth.create');
    }// end method

    public function store(Request $request)
    {
        $validated = $request->validate([
            
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'term' =>'required'
            
        ]);

        $user = new User;
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->save();

        event(new Registered($user));

        return redirect(route('auth'))->with('success','success create new account '.$validated['name']);

    }// end method

    public function forgot_password()
    {
        return view('auth.forgot_password');
    }//end method

    public function forgot_password_email(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );
     
        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['success' => __($status)])
                    : back()->withErrors(['email' => __($status)]);

    }//end method

    public function reset(string $token)
    {   
        return view('auth.reset_forgot_password', ['token' => $token]);

    }//end method

    public function reset_password(Request $request)
    {

        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
     
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );
     
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('auth')->with('success', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }//end method

    public function varify()
    {
        return view('auth.varify');
    }//end method
}//end class
