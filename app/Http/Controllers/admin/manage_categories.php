<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class manage_categories extends Controller
{
    public function index(Request $request){
        
        if($request->file('icon')!='') {
            $file=$request->file('icon');
            $c_name=addslashes($request->input('name'));
            
            //Move Uploaded File
            $destinationPath = 'images/icons';
            if($file->move($destinationPath,$file->getClientOriginalName())) {
                $name=$file->getClientOriginalName();
                DB::insert("INSERT INTO categories (name, icon) VALUES ('$c_name', '$name')");
            }
        }
        
        if($request->input('delete_id')!='') {
            $id=$request->input('delete_id');
            DB::delete("DELETE FROM categories WHERE id='$id'");
        }
        $row=DB::select("SELECT * FROM categories ORDER BY name ASC");
        return view('admin/manage_categories.index', ['categories'=>$row]);
    }
    
    public function edit_category(Request $request, $id){
        
        if($request->file('icon')!='') {
            $file=$request->file('icon');
            
            //Move Uploaded File
            $destinationPath = 'images/icons';
            if($file->move($destinationPath,$file->getClientOriginalName())) {
                $name=$file->getClientOriginalName();
                DB::update("UPDATE categories SET icon='$name' WHERE id='$id'");
            }
        }
        
        if($request->input('name')!='') {
            $c_name=addslashes($request->input('name'));
            
            DB::update("UPDATE categories SET name='$c_name' WHERE id='$id'");
        }
        
        if($request->input('delete_id')!='') {
            $id=$request->input('delete_id');
            DB::delete("DELETE FROM categories WHERE id='$id'");
        }
        
        $row=DB::select("SELECT * FROM categories WHERE id='$id' LIMIT 1");
        if(count($row)==0) return redirect('admin/manage-categories');
        $row=collect($row)->first();
        return view('admin/edit_category.index', ['category'=>$row]);
    }
}
