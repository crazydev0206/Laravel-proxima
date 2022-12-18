<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class manager_applications extends Controller
{
    public function index(Request $request){
        if($request->input('delete')!='') {
            $id=$request->input('delete');
            $row=DB::select("DELETE FROM manager_requests WHERE id='$id'");
        }
        
        if($request->input('accept')!='') {
            $id=$request->input('accept');
            $row=DB::select("SELECT user_id FROM manager_requests WHERE id='$id'");
            $row=collect($row)->first();
            
            $user=$row->user_id;
            $update=DB::update("UPDATE manager_requests SET status='2' WHERE id='$id'");
            $update=DB::update("UPDATE users SET type='2' WHERE id='$user'");
        }
        
        if($request->input('reject')!='') {
            $id=$request->input('reject');
            $reason=$request->input('reason');
            $row=DB::select("SELECT user_id FROM manager_requests WHERE id='$id'");
            $row=collect($row)->first();
            
            $user=$row->user_id;
            $update=DB::update("UPDATE manager_requests SET status='3', reason='$reason' WHERE id='$id'");
        }
        
        $applications=array(); $i=0;
        $row=DB::select("SELECT * FROM manager_requests ORDER BY id DESC");
        foreach($row as $app){
            $user=$app->user_id;
            $applications[$i]['id']=$app->id;
            $applications[$i]['status']=$app->status;
            $applications[$i]['reason']=$app->reason;
            $applications[$i]['req_on']=$app->req_on;
            $applications[$i]['phone']=$app->phone;
            if($app->business!="")
            $applications[$i]['business']=$app->business;
            else $applications[$i]['business']='--';
            $applications[$i]['address']=$app->address;
            $applications[$i]['message']=$app->message;
            $row2=DB::select("SELECT name, email FROM users WHERE id='$user' LIMIT 1");
            $row2=collect($row2)->first();
            $applications[$i]['user']=$user;
            $applications[$i]['user_name']=$row2->name;
            $applications[$i]['user_email']=$row2->email;
            $i++;
        }
        return view('admin.manager_applications.index',['applications'=>$applications]);
    }
}
