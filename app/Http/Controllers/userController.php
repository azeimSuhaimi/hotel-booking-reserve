<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    public function change_password()
    {
        return view('user.change_password');
    }//end method

    public function change_password_update(Request $request)
    {
        $validated = $request->validate([
            'password' => 'required',
            'password1' => 'required|min:4',
            'password2' => 'required|min:4|same:password1',
        ]);

        if (! Hash::check($validated['password'], $request->user()->password)) {

            return back()->with('error','current password not match')->onlyInput('password1','password2','password');
        }

        $pass = Hash::make($validated['password1']);

        $users = User::find(auth()->user()->id);
        $users->password = $pass;
        $users->save();

        $request->session()->passwordConfirmed();

        return back()->with('success','current password is update now');

        
    }//end method

}//end class
