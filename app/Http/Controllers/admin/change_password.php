<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class change_password extends Controller
{
    public function index(Request $request){
        $admin_id=$request->session()->get('admin_id');
        $admin_type=$request->session()->get('admin_type');
        
        if($request->input('pass')!=''){
            $pass=$request->input('pass');
            $pass1=$request->input('pass1');
            $pass2=$request->input('pass2');
            
            $row=DB::select("SELECT id FROM admin WHERE id='$admin_id' AND pass='$pass'");
            if(count($row)==1) {
                if($pass1==$pass2) {
                    DB::update("UPDATE admin SET pass='$pass1' WHERE id='$admin_id'");
                    $request->session()->flash('success','Password updated successfully.');
                }
                else $request->session()->flash('error','Passwords did not match!');
            }
            else $request->session()->flash('error','Current Password is not correct.');
            
            return redirect('admin/change-password');
        }
        return view('admin.change_password.index');
    }
}
