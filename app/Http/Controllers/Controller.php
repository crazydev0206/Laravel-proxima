<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function random_numbers($length = 5){
        $num = '1234567890';
        $ch = '';

        for($i = 0; $i < $length; $i++){
            $ch .= $num[mt_rand(0, strlen($num))];
        }

        return $ch;
    }

    public function random_strings($l = null){
        $num = 'aAbBcCdDeEfFgGhHiIjJkKlLmMnNopPqQrRsStTuUvVwWxXyYzZ1234567890';
        $ch;

        for($i = 0; $i < $l;$i++){
            $ch = $num[mt_rand(0, strlen($num))];
        }

        return $ch;
    }

    public function upload_image($file, $dir){

        $data = null;

        $img_name = $file->getClientOriginalName();
        $array = explode('.', $img_name);
        $img_name = $array[0];
        $ext = $array[1];
        $img_name = rand(pow(10, 4 - 1), pow(10, 4) - 1) . '.' . $ext;

        $fileName = $dir . $img_name; // renameing image

        if ($file->move($dir, $img_name)) {
            $data['name'] = $img_name;
            $data['success'] = 1;
        }


        return $data;

    }
}

