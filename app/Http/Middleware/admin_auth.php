<?php

namespace App\Http\Middleware;

use Closure;
use DB;

class admin_auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->session()->get('admin_id')=="")
            return redirect('/admin/login');
        else {
            $id=$request->session()->get('admin_id');
            $type=$request->session()->get('admin_type');
            
            $admin=DB::select("SELECT id FROM admin WHERE id='$id' LIMIT 1");
            $admin=collect($admin)->first();
            
            $pending=DB::select("SELECT id FROM users WHERE status!='1' AND status!='3'");
            $dpending=DB::select("SELECT id FROM users WHERE driver='2'");
            $spending=DB::select("SELECT id FROM users WHERE student='2'");
            $w_requests=DB::select("SELECT id FROM withdrawal_requests WHERE status='0'");
            view()->share(['admin_type'=>$type, 'admin'=>$admin, 'pending'=>$pending, 'spending'=>$spending, 'dpending'=>$dpending, 'w_requests'=>$w_requests]);
        }
        return $next($request);
    }
}
