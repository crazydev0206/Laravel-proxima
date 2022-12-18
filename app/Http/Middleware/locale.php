<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Config;
use Session;
use DB;

class locale
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
        
        $raw_locale = Session::get('locale');
     if (in_array($raw_locale, Config::get('app.locales'))) {
       $locale = $raw_locale;
     }
     else $locale = Config::get('app.locale');
       App::setLocale($locale);
        
        if($user_id!='') DB::update("UPDATE users SET lang='$locale' WHERE id='$user_id'");
            
        view()->share(['lang'=>$locale]);
        return $next($request);
    }
}
