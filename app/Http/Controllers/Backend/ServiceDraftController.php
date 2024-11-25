<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ServiceDraft;
use Illuminate\Http\Request;

class ServiceDraftController extends Controller
{
    public function index()
    {
        $services = ServiceDraft::all();
        return view('service-draft.index',compact('services'));

    }

    public function edit($id = null)
    {
        if($id){

            $draft = ServiceDraft::findOrFail($id);
        }else{
            $draft ='';
        }
        return view('service-draft.form',compact('draft'));
    }
    

    // public function store(Request $request)
    // {
    //     $draftId = $request->id;
    
    //     $ServiceData = $draftId ? ServiceDraft::find($draftId) : new ServiceDraft();
    //     $ServiceData->status = $request->submit_status ?? 0;
    //     $ServiceData->title = $request->title;
    //     $ServiceData->subtitle = $request->subtitle;
    //     $ServiceData->service_type = $request->service_type;
    //     $ServiceData->description_1 = $request->description_1;
    //     $ServiceData->description_2 = $request->description_2;
    //     $ServiceData->pointers = $request->pointers ? json_encode($request->pointers) : null;
    //     $ServiceData->button_content = $request->button_content;
    //     $ServiceData->button_link = $request->button_link;
    //     $ServiceData->background_color = $request->background_color;
    
    //     if ($request->hasFile('background_image')) {
    //         $backgroundImageName = time() . '_' . $request->file('background_image')->getClientOriginalName();
    //         $backgroundImagePath = $request->file('background_image')->storeAs('service', $backgroundImageName, 'public');
    //         $ServiceData->background_image = 'storage/' . $backgroundImagePath;
    //     }
    
    //     if ($request->hasFile('image')) {
    //         $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
    //         $imagePath = $request->file('image')->storeAs('service', $imageName, 'public');
    //         $ServiceData->image = 'storage/' . $imagePath;
    //     }
    
    //     $ServiceData->save();
    
    //     if ($request->ajax()) {
    //         return response()->json(['draft_id' => $ServiceData->id]);
    //     }
    
    //     return redirect()->route('service-draft.index');
    // }
    
    
    public function store(Request $request)
    {
        // Check if a draft ID is passed, otherwise create a new instance
        $draftId = $request->id;
        $ServiceData = $draftId ? ServiceDraft::find($draftId) : new ServiceDraft();
    
        // Set the submit status
        $ServiceData->status = $request->submit_status ?? 0; // Ensure status is set correctly
        // dd($ServiceData);
        // Set other fields
        $ServiceData->title = $request->title;
        $ServiceData->subtitle = $request->subtitle;
        $ServiceData->service_type = $request->service_type;
        $ServiceData->description_1 = $request->description_1;
        $ServiceData->description_2 = $request->description_2;
        $ServiceData->pointers = $request->pointers ? json_encode($request->pointers) : null;
        $ServiceData->button_content = $request->button_content;
        $ServiceData->button_link = $request->button_link;
        $ServiceData->background_color = $request->background_color;
    
        // Handle file uploads
        if ($request->hasFile('background_image')) {
            $backgroundImageName = time() . '_' . $request->file('background_image')->getClientOriginalName();
            $backgroundImagePath = $request->file('background_image')->storeAs('service', $backgroundImageName, 'public');
            $ServiceData->background_image = 'storage/app/public/' . $backgroundImagePath;
        }

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $imagePath = $request->file('image')->storeAs('service', $imageName, 'public');
            $ServiceData->image = 'storage/app/public/' . $imagePath;
        }
    
        // Save data
        $ServiceData->save();
    
        // If the request is an AJAX call, return the draft ID
        if ($request->ajax()) {
            return response()->json(['draft_id' => $ServiceData->id]);
        }
    
        // Redirect after saving
        return redirect()->route('service-draft.index');
    }
    
}
