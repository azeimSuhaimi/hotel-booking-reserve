<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class frontPageController extends Controller
{
    public function index()
    {
        return view('front_page.index');
    }//end method
}//end class
