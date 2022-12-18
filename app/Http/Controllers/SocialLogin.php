<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SocialLogin extends Controller
{
    public function facebook_redirect(Request $request)
    {
        return Socialite::driver('facebook')->stateless()->redirect();
    }

    public function facebook_callback(Request $request)
    {

        try {
           
            $user = Socialite::driver('facebook')->stateless()->user();
            //var_dump($user);
    
            $f_id = $user->getId();
            $name = $user->getName();
            $email = $user->getEmail();
            $avatar = $user->getAvatar();
            $username = str_replace(' ', '-', strtolower($name));
            $username = preg_replace("/[^A-Za-z0-9-]/", '', $username);
            $password = Hash::make($name.'@'.$f_id);

            $check = DB::select("SELECT id FROM users WHERE username='$username' LIMIT 1");
            if (count($check) == 1) {
                $username = $username . '-' . rand(pow(10, 4 - 1), pow(10, 4) - 1);
            }
    
    
        } catch (\Throwable $th) {
            //throw $th;
        }
      
       
    }
}