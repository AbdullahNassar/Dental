<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Packages extends Model {

	public function get($value)
    {
        $pack = DB::table('packages')
            ->select($value)
            ->first();

    if($pack)
        return $pack->$value;
    return '';
    }

}
