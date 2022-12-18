<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class edit_project extends Controller
{
    public function index(Request $request, $id) {
        if($request->input('title')!=''){
            $title=addslashes($request->input('title'));
            $description=addslashes($request->input('description'));
            $regular_price=$request->input('regular_price');
            $join_price=$request->input('join_price');
            $price=$request->input('price');
            $start=$request->input('start');
            $end=$request->input('end');
            $deadline=$request->input('deadline');
            $cancel_policy=addslashes($request->input('cancel_policy'));
            $min_members=$request->input('min_members');
            $max_members=$request->input('max_members');
            $category=$request->input('category');
            
            DB::update("UPDATE projects SET title='$title', description='$description', regular_price='$regular_price', join_price='$join_price', price='$price', category='$category', start='$start', end='$end', cancel_policy='$cancel_policy', min_members='$min_members', max_members='$max_members', deadline='$deadline' WHERE id='$id'");
        }
        $row=DB::select("SELECT * FROM projects WHERE id='$id' LIMIT 1");
        $row=collect($row)->first();
        $row2=DB::select("SELECT name FROM categories ORDER BY name ASC");
        return view('admin.edit_project.index', ['project'=>$row, 'categories'=>$row2]);
    }
}
