<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class projects_reports extends Controller
{
    public function index(Request $request) {
        
        if($request->input('delete_id')!='') {
            $id=$request->input('delete_id');
            
            DB::delete("DELETE FROM flags WHERE id='$id'");
        }
        
        $row=DB::select("SELECT * FROM flags ORDER BY id DESC");
        $projects=array(); $i=0;
        foreach($row as $r){
            $user=$r->user_id;
            $p_id=$r->p_id;
            $projects[$i]['id']=$r->id;
            $projects[$i]['p_id']=$r->p_id;
            $row2=DB::select("SELECT name, email FROM users WHERE id='$user' LIMIT 1");
            if(count($row2)==0) $by='User has been deleted!';
            else {
            $row2=collect($row2)->first();
            $by=$row2->name.' <br>('.$row2->email.')';
            }
            $projects[$i]['reported_by']=$by;
            $projects[$i]['report']=$r->report;
            $projects[$i]['reported_on']=$r->on_date;
            
            $row2=DB::select("SELECT title, description, user_id FROM projects WHERE id='$p_id' LIMIT 1");
            if(count($row2)==0) $project='Project has been deleted!';
            else {
            $row2=collect($row2)->first();
            $project='1';
            $owner=$row2->user_id;
            $projects[$i]['title']=$row2->title;
            $projects[$i]['description']=$row2->description;
                
            $row2=DB::select("SELECT name, email FROM users WHERE id='$owner' LIMIT 1");
            if(count($row2)==0) $by='User has been deleted!';
            else {
            $row2=collect($row2)->first();
            $by=$row2->name.' <br>('.$row2->email.')';
            }
            $projects[$i]['posted_by']=$by;
            }
            $i++;
        }
        return view('admin.projects_reports.index', ['all_reports'=>$projects]);
    }
}
