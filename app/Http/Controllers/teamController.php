<?php

namespace App\Http\Controllers;

use App\Models\team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class teamController extends Controller
{
    public function index()
    {
        $teams = team::latest()->get();
        return view('team.index',['teams' => $teams]);
    }//end method

    public function add(Request $request)
    {       
        return view('team.add');
    }//end method

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string',
            'position' =>'required',
            'facebook' => 'required|url',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


                // validate file upload 
                if ($request->hasFile('file')) 
                {
                    // get upload image to change and validated rule
                    $file = $request->file('file');
                    $fileName = time().'.'.$file->getClientOriginalExtension();// change name file avoid redundant
            
                    $file->move(public_path('team/'), $fileName); // location image store
        
                    
                    $team = new team;
                    $team->name = $validated['name'];
                    $team->position = $validated['position'];
                    $team->facebook = $validated['facebook'];
                    $team->image = 'team/'.$fileName;
                    $team->save();
        
                    return redirect(route('all.team'))->with('success',$fileName);
                    
                }//end validated file
            return redirect(route('add.team'))->with('error','fail add team');

    }// end method

    public function destroy(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required',

        ]);

        $team = team::find($validated['id']);
        $filePath = public_path($team->image); // store file to location

        // delete fine from past
        if (File::exists($filePath)) {
            File::delete($filePath);
        }
        $team->delete();

        return redirect(route('all.team'))->with('success','delete team');
    }

    public function edit(Request $request,$id)
    {       
        $team = team::find($id);
        return view('team.edit',['team' => $team,'id' => $id]);
    }//end method

    public function update(Request $request,$id)
    {

        $validated = $request->validate([
            'name' => 'required|string',
            'position' =>'required',
            'facebook' => 'required|url',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $team = team::find($id);
            // validate file upload 
            if ($request->hasFile('file')) 
            {
                // get upload image to change and validated rule
                $file = $request->file('file');
                $fileName = time().'.'.$file->getClientOriginalExtension();// change name file avoid redundant
        
                $file->move(public_path('team/'), $fileName); // location image store
    
                
                if($team->image != 'team/empty.png')
                {
                    $filePath = public_path($team->image); // store file to location
    
                    // delete fine from past
                    if (File::exists($filePath)) {
                        File::delete($filePath);
                    }
                }
                $team->image = 'team/'.$fileName;
                
            }//end validated file

            $team->name = $validated['name'];
            $team->position = $validated['position'];
            $team->facebook = $validated['facebook'];

            $team->save();

            return redirect(route('edit.team',['id' => $id]))->with('success','success');

    }// end method
    
}//end class
