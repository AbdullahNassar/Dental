<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\language;
use DB;

class About extends Model
{
    public function get($value)
    {
        $abouts = DB::table('about')
            ->select($value)
            ->first();

    if($abouts)
        return $abouts->$value;
    return '';
    }
}
