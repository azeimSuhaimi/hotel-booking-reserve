<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\user;
//use App\Models\activity_log;

class AdminController extends Controller
{
    public function admindashboard()
    {
        return view('admin.index');
    }//end method

    public function adminlogin()
    {
        return view('admin.adminlogin');
    }//end method

    public function adminlogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }//end method

    public function adminprofile()
    {
        return view('admin.adminprofile');
    }//end method

    public function AdminPasswordUpdate(Request $request)
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

        $users = user::find(auth()->user()->id);
        $users->password = $pass;
        $users->save();

        $request->session()->passwordConfirmed();

        //activity_log::addActivity('Change Password',' change it password to new');

        return back()->with('success','current password is update now');

        
    }//end method

}//end class
