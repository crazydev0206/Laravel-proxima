<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class manage_projects extends Controller
{
    public function index(Request $request) {
        if($request->input('feature_id')!='') {
            $id=$request->input('feature_id');
            if($request->input('feature_status')=='0')
            $feature='1';
            else $feature='0';
            
            DB::update("UPDATE projects SET feature='$feature' WHERE id='$id'");
        }
        
        if($request->input('delete_id')!='') {
            $id=$request->input('delete_id');
            
            DB::delete("DELETE FROM projects WHERE id='$id'");
        }
        
        $row=DB::select("SELECT * FROM projects ORDER BY id DESC");
        $projects=array(); $i=0;
        foreach($row as $r){
            $user=$r->user_id;
            $row2=DB::select("SELECT name, email FROM users WHERE id='$user' LIMIT 1");
            if(count($row2)==0) $by='User has been deleted!';
            else {
            $row2=collect($row2)->first();
            $by=$row2->name.' <br>('.$row2->email.')';
            }
            $projects[$i]['posted_by']=$by;
            $projects[$i]['title']=$r->title;
            $projects[$i]['description']=$r->description;
            $projects[$i]['price']=$r->price;
            if($r->currency=='1') 
            $projects[$i]['currency']='CAD';
            else
            $projects[$i]['currency']='USD';
            $projects[$i]['category']=$r->category;
            $projects[$i]['posted_on']=$r->posted_on;
            $projects[$i]['views']=$r->views;
            $projects[$i]['location']=$r->location;
            $projects[$i]['id']=$r->id;
            $projects[$i]['feature']=$r->feature;
            $i++;
        }
        return view('admin.all_projects.index', ['all_projects'=>$projects]);
    }
}
