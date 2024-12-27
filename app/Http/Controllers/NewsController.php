<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    public function index() 
    { 
        $news = News::all();         
        return view('news', compact('news')); 
    } 
 
    public function editNews(News $id_news) 
    { 
        // $news = News::find($id_news); 
        return view('editNews', compact('id_news')); 
    } 
 
    function saveNews(Request $request) 
    {         
        try { 
            $validated = $request->validate([ 
                'title' => 'required', 
                'file' => 'required|mimes:jpg,jpeg,png|max:10024', 
                'content' => 'required' 
            ]); 
 
            if (!$validated) {                 
                return redirect()->back(); 
            } 
 
            $fileName = $request->file->hashName(); 
            $request->file->move(public_path('image'), $fileName); 
            // $request->file->storeAs('uploads', $fileName); 
 
            $news = new News(); 
            $news->title = $request->title; 
            $news->content = $request->content; 
            $news->name_file = $fileName; 
 
            if ($news->save()) { 
                $status = "success"; 
                $message = "Save Data Success"; 
            } else { 
                $status = "failed"; 
                $message = "Save Data Failed"; 
            } 
 
            // return redirect()->to('/addNews')->with($status, $message);             
            return redirect()->back()->with($status, $message); 
                } catch (\Throwable $e) {             
            return redirect()->back()->with("failed", "Save Data failed because " . $e->getMessage()); 
            } 
    } 
 
    function updateNews(Request $request, $id_news) 
    {         
        try { 
            $validated = $request->validate( 
                [ 
                    'title' => 'required', 
                    'file' => 'mimes:jpg,jpeg,png|max:1024', 
                    'content' => 'required' 
                ], 
                [ 
                    'title.required' => 'Title wajib diisi', 
                    'content.required' => 'Content wajib diisi', 
                    'file.max' => 'File maksimal 1 MB', 
                    'foto.mimes' => 'File ekstensi hanya bisa jpg,png,jpeg,gif, svg',                     
                    'foto.image' => 'File harus berbentuk image' 
                ] 
            ); 
 
            if (!$validated) { 
                return redirect()->back(); 
            } 
 
            $oldFile = DB::table('news')->select('name_file')->where('id_news', $id_news)->get();             
            foreach ($oldFile as $f1) { 
                $oldFile = $f1->name_file; 
            } 
 
            if (!empty($request->file)) {                 
            if (!empty($oldFile->name_file)) unlink(public_path('image' . $oldFile->name_file)); 
                $fileName = $request->file->hashName(); 
                $request->file->move(public_path('image'), $fileName); 
            } else { 
                $fileName = $oldFile; 
            } 
            $news = News::find($id_news); 
            $news->title = $request->title; 
            $news->content = $request->content; 
            $news->name_file = $fileName; 
 
            if ($news->update()) {                 
                $status = "success"; 
                $message = "Update Data Success"; 
            } else { 
                $status = "failed"; 
                $message = "Update Data failed"; 
            } 
            return redirect()->back()->with($status, $message); 
        } catch (\Throwable $e) {             
            return redirect()->back()->with("failed", "Update Data failed because " . $e->getMessage()); 
        } 
    } 
 
    function deleteNews($id_news) 
    { 
        $news = News::find($id_news); 
 
        if ($news->delete()) {             
            $status = "success"; 
            $message = "Delete Data Success"; 
        } else { 
            $status = "failed"; 
            $message = "Delete Data failed"; 
        } 
 
        return redirect()->back()->with($status, $message); 
    } 
} 

