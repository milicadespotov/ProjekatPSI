<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Picture extends Model
{
    public static function mainPicture($id) {
        return DB::table('pictures')
            ->where('content_id','=',$id)
            ->where('main_picture','=',1)
            ->select('path')
            ->get()
            ->first();
    }
    public static function notMainPictures($id) {
        return DB::table('pictures')
            ->where('content_id','=',$id)
            ->where('main_picture','=',0)
            ->select('path')
            ->get();
    }
}
