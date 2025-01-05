<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

}//end class
