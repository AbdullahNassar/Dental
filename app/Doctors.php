<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctors extends Model {

	public function get($value)
    {
        $doc = DB::table('doctors')
            ->select($value)
            ->first();

    if($doc)
        return $doc->$value;
    return '';
    }

}
