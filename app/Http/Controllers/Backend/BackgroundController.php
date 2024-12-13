<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BackgroundImage;

class BackgroundController extends Controller
{
    public function background($category)
    {
        $centerData = new BackgroundImage;
        return view('about.background',compact('centerData','category'));
    }
    public function savebackground(Request $request)
    {
        try {
            $background = BackgroundImage::where('category',$request->category)->first();
            if(!$background)
            {
                $background = new BackgroundImage;
            }
            $background->category = $request->category;
            if($request->type == 'image')
            {
                $background->background_color = '';
                if ($request->hasFile('background_image')) {
                    $backgroundImageName = time() . '_' . $request->file('background_image')->getClientOriginalName();
                    $backgroundImagePath = $request->file('background_image')->storeAs('about', $backgroundImageName, 'public');
                    $background->background_image = 'storage/app/public/' . $backgroundImagePath;
                }
            }else{
                $background->background_color = $request->background_color;
                $background->background_image = '';
            }
            $background->save(); 
            return back()->with('success', 'Record created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create record: ' . $e->getMessage());
        }
    }
}
