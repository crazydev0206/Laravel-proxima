<?php

namespace App\Http\Middleware;

use Closure;
use DB;

class auth
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
        $id=$request->session()->get('id');
        if($id=='') {
            $url=url()->current();
            $request->session()->put('next', $url);
            return redirect('signin');
        }
        
        $user=DB::select("SELECT * FROM users WHERE id='$id' LIMIT 1");
        $user=collect($user)->first();
        view()->share(['id'=>$id, 'user'=>$user]);
        
        return $next($request);
    }
}
