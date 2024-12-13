<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Header;
use Illuminate\Http\Request;
use App\Models\Service;

use App\Http\Resources\HeaderResource;
use Illuminate\Support\Facades\Storage;

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
        $service = new Service();
        $headerChild = Header::with('children')->whereNull('parent_id')->where('category','Services')->get();
        $links = Header::where('link','!=','')->get();

        $headerChild = HeaderResource::collection($headerChild);
      
        // dd($headerChild[0]['children'][0]['category']);
        return view('Service.form',compact('headerChild','service','links'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceRequest $request)
    {
        $ServiceData = new Service;
        $ServiceData->title = $request->title;
        $ServiceData->description_1 = $request->description_1;
        $ServiceData->subtitle = $request->subtitle;
        $ServiceData->service_type = $request->service_type;
        $ServiceData->description_2 = $request->description_2;
        $ServiceData->pointers =json_encode($request->pointers);
        $ServiceData->button_content = $request->button_content;
        $ServiceData->button_link = $request->button_link;
        $ServiceData->show_on_home_page = $request->show_on_home_page;
        $ServiceData->status = $request->status;
        $ServiceData->type = $request->type;

        if($request->type == 'image')
        {
            $ServiceData->background_color = '';

            if ($request->hasFile('background_image')) {
                $backgroundImageName = time() . '_' . $request->file('background_image')->getClientOriginalName();
                $backgroundImagePath = $request->file('background_image')->storeAs('service', $backgroundImageName, 'public');
                $ServiceData->background_image = 'storage/app/public/' . $backgroundImagePath;
            }
        }else{
            $ServiceData->background_color = $request->background_color;
            $ServiceData->background_image = '';
        }

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $imagePath = $request->file('image')->storeAs('service', $imageName, 'public');
            $ServiceData->image = 'storage/app/public/' . $imagePath;
        }
        $ServiceData->save();
       
        return redirect()->route('service.index');
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
        $service = Service::find($id);
        $headerChild = Header::with('children')->whereNull('parent_id')->where('category','Services')->get();
        $links = Header::where('link','!=','')->get();

        $headerChild = HeaderResource::collection($headerChild);
      
        // dd($headerChild[0]['children'][0]['category']);
        return view('Service.form',compact('headerChild','service','links'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServiceRequest $request)
    {
        try {
            $ServiceData = Service::findOrFail($request->hidden_id);
            if ($request->hasFile('image')) {
                $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
                $imagePath = $request->file('image')->storeAs('service', $imageName, 'public');
                $ServiceData->image = 'storage/app/public/' . $imagePath;
            }
            $ServiceData->title = $request->title;
            $ServiceData->subtitle = $request->subtitle;
            $ServiceData->service_type = $request->service_type;
            $ServiceData->description_1 = $request->description_1;
            $ServiceData->description_2 = $request->description_2;
            $ServiceData->button_content = $request->button_content;
            $ServiceData->button_link = $request->button_link;
            $ServiceData->pointers =json_encode($request->pointers);
            $ServiceData->show_on_home_page = $request->show_on_home_page;
            $ServiceData->status = $request->status;
            $ServiceData->type = $request->type;

            if($request->type == 'image')
             {
                $ServiceData->background_color = '';
                if ($request->hasFile('background_image')) {
                    $backgroundImageName = time() . '_' . $request->file('background_image')->getClientOriginalName();
                    $backgroundImagePath = $request->file('background_image')->storeAs('service', $backgroundImageName, 'public');
                    $ServiceData->background_image = 'storage/app/public/' . $backgroundImagePath;
                }
            }else{
                $ServiceData->background_color = $request->background_color;
                $ServiceData->background_image = '';
            }
            $ServiceData->save();

            return redirect()->route('service.index')->with('success', 'Record updated successfully!');
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
            $ServiceData = Service::findOrFail($id);

            if ($ServiceData->background_image) {
                Storage::delete('public/' . $ServiceData->background_image);
            }

            if ($ServiceData->image) {
                Storage::delete('public/' . $ServiceData->image);
            }

            $ServiceData->delete();

            return redirect()->route('service.index')->with('success', 'Record deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('service.index')->with('error', 'Failed to delete record: ' . $e->getMessage());
        }
    }
}
