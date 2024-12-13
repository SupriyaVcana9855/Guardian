<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\contentRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\PageContent;

class PageContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $content = PageContent::all();
        return view('content.index', compact('content'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $content = new PageContent;
        return view('content.form', compact('content'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $content = new PageContent();
            $content->title = $request->title;
            $content->subtitle = $request->subtitle;
           	$content->description_1 = $request->description_1;
   			$content->description_2 = $request->description_2;
            $content->button_content = $request->button_content;
            $content->button_link = $request->button_link;
            $content->content_alignment = $request->content_alignment;
            $content->type = $request->type;

            if ($request->hasFile('image')) {
                $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
                $imagePath = $request->file('image')->storeAs('content', $imageName, 'public');
                $content->image = 'storage/app/public/' . $imagePath;
            }
          
          
           if($request->type == 'image')
            {
                $content->content_background_color = '';
                if ($request->hasFile('background_image')) {
                    $backgroundImageName = time() . '_' . $request->file('background_image')->getClientOriginalName();
                    $backgroundImagePath = $request->file('background_image')->storeAs('content', $backgroundImageName, 'public');
                    $content->content_background_image = 'storage/app/public/' . $backgroundImagePath;
                }
            }else{
                $content->content_background_color = $request->background_color;
                $content->content_background_image = '';
            }
          
          
            $content->save();

                 
            return redirect()->route('content.index')->with('success', 'Record created successfully!');
        } catch (\Exception $e) {
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
        $content = PageContent::find($id);
        return view('content.form', compact('content'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $content = PageContent::findOrFail($request->hidden_id);
             if ($request->hasFile('image')) {
                $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
                $imagePath = $request->file('image')->storeAs('content', $imageName, 'public');
                $content->image = 'storage/app/public/' . $imagePath;
            }
            $content->title = $request->title;
            $content->subtitle = $request->subtitle;
           	$content->description_1 = $request->description_1;
   			 $content->description_2 = $request->description_2;
            $content->button_content = $request->button_content;
            $content->button_link = $request->button_link;
            $content->content_alignment = $request->content_alignment;
                      $content->type = $request->type;

            if($request->type == 'image')
            {
                $content->content_background_color = '';
                if ($request->hasFile('background_image')) {
                    $backgroundImageName = time() . '_' . $request->file('background_image')->getClientOriginalName();
                    $backgroundImagePath = $request->file('background_image')->storeAs('content', $backgroundImageName, 'public');
                    $content->content_background_image = 'storage/app/public/' . $backgroundImagePath;
                }
            }else{
                $content->content_background_color = $request->background_color;
                $content->content_background_image = '';
            }
          
            $content->save();
            return redirect()->route('content.index')->with('success', 'Record updated successfully!');
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
            $content = PageContent::findOrFail($id);

            if ($content->background_image) {
                Storage::delete('public/' . $content->background_image);
            }

            if ($content->image) {
                Storage::delete('public/' . $content->image);
            }

            $content->delete();

            return redirect()->route('content.index')->with('success', 'Record deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('content.index')->with('error', 'Failed to delete record: ' . $e->getMessage());
        }
    }
}
