<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class dashboard extends Controller
{
    public function index(Request $request){
        $admin_id=$request->session()->get('admin_id');
        $admin_type=$request->session()->get('admin_type');
        
        $driver_count=DB::select("SELECT id FROM users WHERE driver='1' AND deleted='0'");
        $student_count=DB::select("SELECT id FROM users WHERE student='1' AND deleted='0'");
        $passenger_count=DB::select("SELECT id FROM users WHERE deleted='0'");
        $rides_count=DB::select("SELECT id FROM rides");
        $ratings_count=DB::select("SELECT id FROM ratings");
        
        return view('admin.dashboard.index', ['driver_count'=>$driver_count, 'student_count'=>$student_count, 'passenger_count'=>$passenger_count, 'rides_count'=>$rides_count, 'ratings_count'=>$ratings_count]);
    }
    
    public function access_portal(Request $request, $id)
    {
        $user=DB::select("SELECT id FROM users WHERE id='$id' LIMIT 1");
        if(count($user)==1)
        {
            $request->session()->put('id', $id);
            return redirect('personal-information');
        }
        echo 'User does not exist.';
    }
}
