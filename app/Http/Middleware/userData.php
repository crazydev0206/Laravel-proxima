<?php

namespace App\Http\Middleware;

use Closure;
use Cookie;
use DB;

class userData
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
        $user_id=$request->session()->get('id');
        if($user_id=='') $user_id=0;
        
        if($user_id==0)
        {
            $token=$request->cookie('user_login_token');
            if($token!='')
            {
                $user=DB::select("SELECT id FROM users WHERE token='$token' LIMIT 1");
                if(count($user)==1)
                {
                    $user=collect($user)->first();
                    $request->session()->put('id', $user->id);
                    $user_id=$user->id;
                }
            }
        }
        
        if($request->input('r')!='')
        {
            $r=$request->input('r');
            $request->session()->put('referral', $r);
        }
        
        $user=DB::select("SELECT * FROM users WHERE id='$user_id' LIMIT 1");
        if($user_id!=0 AND count($user)==0) return redirect('signout');
        $user=collect($user)->first();
        if($user_id!=0 AND $user->suspend==1) { $request->session()->put('id', ''); return redirect('signout'); }
        
        $covid=$request->cookie('covid');
        if($covid=='') $covid='0';
        
        $covid_bar=$request->cookie('covid_bar');
        if($covid_bar=='') $covid_bar='0';
        
        $site=DB::select("SELECT * FROM site ORDER BY id DESC LIMIT 1");
        $site=collect($site)->first();
        
        date_default_timezone_set('Asia/Kolkata');
        
        view()->share((['user'=>$user,'user_id'=>$user_id, 'covid'=>$covid, 'covid_bar'=>$covid_bar, 'site'=>$site]));
        
        return $next($request);
    }
}
