<?php

namespace App\Http\Controllers;

use App\Models\team;
use App\Models\roomtype;
use Illuminate\Http\Request;

class roomtypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roomtype = roomtype::latest()->get();
        return view('roomtype.index',['roomtype' => $roomtype]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('roomtype.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string',
        ]);

        $roomtype = new roomtype;
        $roomtype->name = $validated['name'];
        $roomtype->save();

            return redirect(route('roomtype'))->with('success','success add room typr');

    }// end method

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
