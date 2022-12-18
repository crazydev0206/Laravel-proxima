<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class blogs extends Controller
{
    public function index(Request $request){
        $blogs=DB::select("SELECT * FROM blogs");
        return view('admin.manage_blogs.index', ['blogs'=>$blogs]);
    }
    
    public function manage_forms(Request $request){
        if($request->file('image')!='') {
            $file=$request->file('image');
            
            //Move Uploaded File
            $destinationPath = 'blog_images';
            if($file->move($destinationPath,$file->getClientOriginalName())) {
                $name=$file->getClientOriginalName();
                
                
            $title=addslashes($request->input('title'));
            $description=addslashes($request->input('description'));
                
            DB::insert("INSERT INTO blogs (title, description, on_date, image) VALUES ('$title', '$description', NOW(), '$name')");
            }
        }
        
        if($request->input('delete_id')!=''){
            $id=addslashes($request->input('delete_id'));
            
            DB::delete("DELETE FROM blogs WHERE id='$id'");
        }
        return redirect('admin/manage-blogs');
    }
    
    public function edit_blog(Request $request, $id){
        if($request->file('image')!='') {
            $file=$request->file('image');
            
            //Move Uploaded File
            $destinationPath = 'blog_images';
            if($file->move($destinationPath,$file->getClientOriginalName())) {
                $name=$file->getClientOriginalName();
                
                DB::update("UPDATE blogs SET image='$name' WHERE id='$id'");
            }
        }
        
        if($request->input('title')!=''){
            $title=addslashes($request->input('title'));
            $description=addslashes($request->input('description'));
            
            DB::update("UPDATE blogs SET title='$title', description='$description' WHERE id='$id'");
        }
        
        if($request->input('delete_id')!=''){
            $id=addslashes($request->input('delete_id'));
            
            DB::delete("DELETE FROM blogs WHERE id='$id'");
        }
        
        $blog=DB::select("SELECT * FROM blogs WHERE id='$id' LIMIT 1");
        $blog=collect($blog)->first();
        return view('admin.edit_blog.index', ['blog'=>$blog]);
    }
}
