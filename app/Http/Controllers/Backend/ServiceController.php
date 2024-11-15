<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        return view('Service.index',compact('services'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Service.form');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'subtitle' => 'required', // Ensure subcategories is an array
            'description_1' => 'required',
            'button_content' => 'required', 
            'background_color' => 'required', 
        ]);
        $ServiceData = new Service;
        // Save or update the category
        $ServiceData->title = $request->title;
        $ServiceData->description_1 = $request->description_1;
        $ServiceData->subtitle = $request->subtitle;
        $ServiceData->description_2 = $request->description_2;
        $ServiceData->pointers =json_encode($request->pointers);
        $ServiceData->button_content = $request->button_content;
        $ServiceData->button_link = $request->button_link;
        $ServiceData->background_color = $request->background_color;
        if ($request->hasFile('background_image')) {
            $backgroundImagePath = $request->file('background_image')->store('service', 'public');
            $ServiceData->background_image = $backgroundImagePath;
        }
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('service', 'public');
            $ServiceData->image = $imagePath; 
        }
        $ServiceData->save();
       
        return redirect()->route('services.index');
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