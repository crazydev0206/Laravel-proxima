<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class home extends Controller
{
    function login(){
        return redirect('admin/login');
    }
}
