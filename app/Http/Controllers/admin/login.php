<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class login extends Controller
{
    public function index(Request $request){
        $error="";
        if($request->input('username')!=''){
            $username=$request->input('username');
            $pass=$request->input('pass');
            
            $row=DB::select("SELECT id, type FROM admin WHERE username='$username' AND pass='$pass' LIMIT 1");
            if(count($row)!=0) {
                $row=collect($row)->first();
                $id=$row->id;
                $type=$row->type;
                $request->session()->put('admin_id',$id);
                $request->session()->put('admin_type',$id);
                
                return redirect('admin/dashboard');
            }
            else $error='Invalid credentials.';
        }
        
        return view('admin.login.index',['error'=>$error]);
    }

   
}
