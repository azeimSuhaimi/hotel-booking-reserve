<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
//use App\Models\user;

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


        //edit image for profile 
        public function update_image(Request $request)
        {
            // validated input
            $validated = $request->validate([
                'id' => 'required',
                'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $user = user::find($validated['id']);// find table  based id

            // validate file upload 
            if ($request->hasFile('file')) 
            {
                // get upload image to change and validated rule
                $file = $request->file('file');
                $fileName = time().'.'.$file->getClientOriginalExtension();// change name file avoid redundant
        
                $file->move(public_path('backend/assets/img/'), $fileName); // location image store

                if($user->picture != 'empty.png')
                {
                    
                    $filePath = public_path('backend/assets/img/'.$user->picture); // store file to location

                    // delete fine from past
                    if (File::exists($filePath)) {
                        File::delete($filePath);
                    }

                }
                
                // store image name to database
                $user->picture = $fileName;
                $user->save();

                
                return redirect(route('admin.profile'))->with('success',$fileName);
                
            }//end validated file

            return redirect(route('admin.profile'))->with('error','fail edit image');

        }//end method

        //edit image for profile 
        public function remove_image(Request $request)
        {
            // validated input
            $validated = $request->validate([
                'id' => 'required',
            ]);

            $user = user::find($validated['id']);// find table  based id


                if($user->picture != 'empty.png')
                {
                    
                    $filePath = public_path('backend/assets/img/'.$user->picture); // store file to location

                    // delete fine from past
                    if (File::exists($filePath)) {
                        File::delete($filePath);
                    }

                }
                
                // store image name to database
                    $user->picture = 'empty.png';
                    $user->save();

                    

                return redirect(route('admin.profile'))->with('success','success remove image');
                

        }//end method
    
            
                //update  data 
        public function update_profile(Request $request)
        {
            // validate data profile update base rule
            $validated = $request->validate([
                'name' => 'required|string',
                'address' => 'required|string',
                'phone' =>['required','numeric',Rule::unique('users')->ignore( $request->input('phone'),'phone')] ,
    
                
                
            ]);
    
            //store data update to database
            $user = user::find(auth()->user()->id);
            $user->name = $validated['name'];
            $user->address = $validated['address'];
            $user->phone = $validated['phone'];
            $user->save();
    
            
    
            return redirect(route('admin.profile'))->with('success','edit details profile '.$validated['name']);
    
        }//end method

}//end class
