<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\HomeRequest;
use App\Models\Home;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $homeData = Home::all();
        return view('home.index', compact('homeData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $home = new Home();

        return view('home.form',compact('home'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HomeRequest $request)
    {
        try {
            $homeData = new Home();
            $homeData->title = $request->title;
            $homeData->description = $request->description;
            $homeData->subtitle = $request->subtitle;
            $homeData->button_content = $request->button_content;
            $homeData->button_link = $request->button_link;
            if ($request->hasFile('image')) {
                $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
                $imagePath = $request->file('image')->storeAs('home', $imageName, 'public');
                $homeData->image = 'storage/app/public/' . $imagePath;
            }
            $homeData->save();

        return redirect()->route('home.index')->with('success', 'Record created successfully!');
    } catch (\Exception $e) {
        dd($e->getMessage());
        return redirect()->back()->with('error', 'Failed to create record: ' . $e->getMessage());
    }
}


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
        $home = Home::find($id);
        return view('home.form', compact('home'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HomeRequest $request)
{
    try {
        $homeData = Home::findOrFail($request->hidden_id);
        $homeData->title = $request->title;
        $homeData->description = $request->description;
        $homeData->subtitle = $request->subtitle;
        $homeData->button_content = $request->button_content;
        $homeData->button_link = $request->button_link;

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $imagePath = $request->file('image')->storeAs('home', $imageName, 'public');
            $homeData->image = 'storage/' . $imagePath;
        }
        $homeData->save();
        return redirect()->route('home.index')->with('success', 'Record updated successfully!');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Failed to update record: ' . $e->getMessage());
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $homeData = Home::findOrFail($id);

            if ($homeData->background_image) {
                Storage::delete('public/' . $homeData->background_image);
            }

            if ($homeData->image) {
                Storage::delete('public/' . $homeData->image);
            }

            $homeData->delete();

            return redirect()->route('home.index')->with('success', 'Record deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('home.index')->with('error', 'Failed to delete record: ' . $e->getMessage());
        }
    }


    
}
