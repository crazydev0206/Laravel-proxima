<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DateTime;
use DB;

class videos extends Controller
{
    public function index(Request $request){

        $type = "";

        $msg = "";

        if ($request->input('youtube_link') != null ) {
            // code...
           

            $page = $request->input('page');

            $lang = $request->input('lang');

            $link = $request->input('youtube_link');

            $g = DB::select("SELECT * FROM videos WHERE page = ? AND lang = ?", [$page, $lang]);

            if (count($g) == 0) {
                // code...
                DB::insert("INSERT INTO videos (link, lang, page) VALUES (?, ?, ?)", [$link, $lang, $page]);

                 $type = "success";

                 $msg = "Youtube Link Added Successfully";

            }else{

                $c = collect($g)->first();

                 $type = "success";

                 $msg = "Youtube Link Updated Successfully";

                DB::update("UPDATE videos SET link = ?, lang = ? , page = ? WHERE id = ?", [$link, $lang, $page, $c->id]);

            }

        }
        
        return view('admin.videos.index', ['type'=>$type, 'msg'=>$msg]);
    }
}