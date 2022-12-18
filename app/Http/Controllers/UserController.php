<?php

namespace App\Http\Controllers;

use Config;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function AuthRouteAPI(Request $request)
    {
        return $request->user();
    }

    function setLocale($locale)
    {
        if (in_array($locale, Config::get('app.locales'))) {
            Session::put('locale', $locale);
        }
        return redirect()->back();
    }
}
