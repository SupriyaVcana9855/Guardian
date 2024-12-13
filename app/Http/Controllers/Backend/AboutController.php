<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AboutRequest;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\BackgroundImage;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $about = AboutUs::all();
        return view('about.index', compact('about'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $about = new AboutUs;
        return view('about.form', compact('about'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $about = new AboutUs();
            $about->title = $request->title;
            $about->subtitle = $request->subtitle;
            $about->description_1 = $request->description_1;
            $about->description_2 = $request->description_2;
            $about->button_content = $request->button_content;
            $about->button_link = $request->button_link;
            $about->content_alignment = $request->content_alignment;
            $about->status = $request->status;
            $about->content_background_color = $request->background_color;

            if ($request->hasFile('image')) {
                $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
                $imagePath = $request->file('image')->storeAs('about', $imageName, 'public');
                $about->image = 'storage/app/public/' . $imagePath;
            }
            if ($request->hasFile('background_image')) {
                $backgroundImageName = time() . '_' . $request->file('background_image')->getClientOriginalName();
                $backgroundImagePath = $request->file('background_image')->storeAs('about', $backgroundImageName, 'public');
                $about->background_image = 'storage/app/public/' . $backgroundImagePath;
            }
            // dd($about);
            $about->save();

                 
            return redirect()->route('about.index')->with('success', 'Record created successfully!');
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
        $about = AboutUs::find($id);
        return view('about.form', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $about = AboutUs::findOrFail($request->hidden_id);
             if ($request->hasFile('image')) {
                $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
                $imagePath = $request->file('image')->storeAs('about', $imageName, 'public');
                $about->image = 'storage/app/public/' . $imagePath;
            }
            $about->title = $request->title;
            $about->subtitle = $request->subtitle;
            $about->description_1 = $request->description_1;
            $about->description_2 = $request->description_2;
            $about->button_content = $request->button_content;
            $about->button_link = $request->button_link;
            $about->content_alignment = $request->content_alignment;
            $about->status = $request->status;
            $about->content_background_color = $request->background_color;

            if ($request->hasFile('background_image')) {
                $backgroundImageName = time() . '_' . $request->file('background_image')->getClientOriginalName();
                $backgroundImagePath = $request->file('background_image')->storeAs('about', $backgroundImageName, 'public');
                $about->background_image = 'storage/app/public/' . $backgroundImagePath;
            }
            $about->save();
            return redirect()->route('about.index')->with('success', 'Record updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update record. Please try again.');
        }
    }
    




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $about = AboutUs::findOrFail($id);

            if ($about->background_image) {
                Storage::delete('public/' . $about->background_image);
            }

            if ($about->image) {
                Storage::delete('public/' . $about->image);
            }

            $about->delete();

            return redirect()->route('about.index')->with('success', 'Record deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('about.index')->with('error', 'Failed to delete record: ' . $e->getMessage());
        }
    }
}
