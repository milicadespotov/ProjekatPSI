<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TypeOf extends Model
{
    public static function checkTVShow($tvshow_id, $genre_id) {
        return DB::table('type_ofs')
            ->where('tvshow_id','=',$tvshow_id)
            ->where('genre_id','=',$genre_id)
            ->select('genre_id')
            ->get()
            ->first();
    }
    public static function deleteGenres($id) {
        DB::table('type_ofs')
            ->where('type_ofs.tvshow_id','=',$id)
            ->delete();
    }
}
