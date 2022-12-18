<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class logout extends Controller
{
    public function index(Request $request){
    $request->session()->forget('admin_id');
    $request->session()->forget('admin_type');
        return redirect('/admin/login');
    }
}
