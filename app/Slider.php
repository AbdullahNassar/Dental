<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\language;
use DB;

class Slider extends Model
{
    public function get($value)
    {
        $sliders = DB::table('sliders')
            ->select($value)
            ->first();

    if($sliders)
        return $sliders->$value;
    return '';
    }
}
