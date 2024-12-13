<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
        public function index()
        {
            $news = news::all();
            return view('news.index',compact('news'));
    
        }
    
        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
            $news = new news();
          
            return view('news.form',compact('news'));
    
        }
    
        /**
         * Store a newly created resource in storage.
         */
        public function store(Request $request)
        {
            $newsData = new news;
            $newsData->title = $request->title;
            $newsData->description = $request->description;
            $newsData->subtitle = $request->subtitle;
            $newsData->button_content = $request->button_content;
            $newsData->button_link = $request->button_link;
            $newsData->show_on_home_page = $request->show_on_home_page;
            $newsData->status = $request->status;
            $newsData->type = $request->type;
            if($request->type == 'image')
            {
                $newsData->background_color = '';
    
                if ($request->hasFile('background_image')) {
                    $backgroundImageName = time() . '_' . $request->file('background_image')->getClientOriginalName();
                    $backgroundImagePath = $request->file('background_image')->storeAs('news', $backgroundImageName, 'public');
                    $newsData->background_image = 'storage/app/public/' . $backgroundImagePath;
                }
            }else{
                $newsData->background_color = $request->background_color;
                $newsData->background_image = '';
            }
    
            if ($request->hasFile('image')) {
                $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
                $imagePath = $request->file('image')->storeAs('news', $imageName, 'public');
                $newsData->image = 'storage/app/public/' . $imagePath;
            }

            $newsData->save();
           
            return redirect()->route('news.index');
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
            $news = news::find($id);
            return view('news.form',compact('news'));
        }
    
        /**
         * Update the specified resource in storage.
         */
        public function update(Request $request)
        {
            try {
                $newsData = news::findOrFail($request->hidden_id);
                if ($request->hasFile('image')) {
                    $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
                    $imagePath = $request->file('image')->storeAs('news', $imageName, 'public');
                    $newsData->image = 'storage/app/public/' . $imagePath;
                }
                $newsData->title = $request->title;
                $newsData->subtitle = $request->subtitle;
                $newsData->description = $request->description;
                $newsData->button_content = $request->button_content;
                $newsData->button_link = $request->button_link;
                $newsData->show_on_home_page = $request->show_on_home_page;
                $newsData->status = $request->status;
                $newsData->type = $request->type;
                if($request->type == 'image')
                 {
                    $newsData->background_color = '';
                    if ($request->hasFile('background_image')) {
                        $backgroundImageName = time() . '_' . $request->file('background_image')->getClientOriginalName();
                        $backgroundImagePath = $request->file('background_image')->storeAs('news', $backgroundImageName, 'public');
                        $newsData->background_image = 'storage/app/public/' . $backgroundImagePath;
                    }
                }else{
                    $newsData->background_color = $request->background_color;
                    $newsData->background_image = '';
                }

                $newsData->save();
    
                return redirect()->route('news.index')->with('success', 'Record updated successfully!');
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
                $newsData = news::findOrFail($id);
    
                if ($newsData->background_image) {
                    Storage::delete('public/' . $newsData->background_image);
                }
    
                if ($newsData->image) {
                    Storage::delete('public/' . $newsData->image);
                }
    
                $newsData->delete();
    
                return redirect()->route('news.index')->with('success', 'Record deleted successfully!');
            } catch (\Exception $e) {
                return redirect()->route('news.index')->with('error', 'Failed to delete record: ' . $e->getMessage());
            }
        }
    }
    