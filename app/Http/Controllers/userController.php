<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{

    public function index()
    {
        return view('user.index');
    }//end method

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

    //edit image for profile 
    public function remove_image(Request $request)
    {


        $user = user::find(auth()->user()->id);// find table  based id


            if($user->picture != 'profiles/empty.png')
            {
                
                $filePath = public_path($user->picture); // store file to location

                // delete fine from past
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }

            }
            
            // store image name to database
                $user->picture = 'profiles/empty.png';
                $user->save();

            return redirect(route('user.profile'))->with('success','success remove image');
            

    }//end method

    //edit image for profile 
    public function update_image(Request $request)
    {
        // validated input
        $validated = $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = user::find(auth()->user()->id);// find table  based id

        // validate file upload 
        if ($request->hasFile('file')) 
        {
            // get upload image to change and validated rule
            $file = $request->file('file');
            $fileName = time().'.'.$file->getClientOriginalExtension();// change name file avoid redundant
    
            $file->move(public_path('profiles/'), $fileName); // location image store

            if($user->picture != 'profiles/empty.png')
            {
                $filePath = public_path('profiles/'.$user->picture); // store file to location

                // delete fine from past
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
            }
            
            // store image name to database
            $user->picture = 'profiles/'.$fileName;
            $user->save();

            return redirect(route('user.profile'))->with('success',$fileName);
            
        }//end validated file

        return redirect(route('user.profile'))->with('error','fail edit image');

    }//end method

    //update  data 
    public function update_profile(Request $request)
    {
        // validate data profile update base rule
        $validated = $request->validate([
            'name' => 'required|string',
            'phone' =>'required|numeric|unique:users,phone',
            'address' => 'required|string',
        ]);

        //store data update to database
        $user = user::find(auth()->user()->id);
        $user->name = $validated['name'];
        $user->phone = $validated['phone'];
        $user->address = $validated['address'];
        $user->save();

        return redirect(route('user.profile'))->with('success','edit details profile '.$validated['name']);

    }//end method

}//end class
