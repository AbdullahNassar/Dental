<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\language;
use DB;

class Service extends Model {

	public function get($value)
    {
        $service = DB::table('services')
            ->select($value)
            ->first();

    if($service)
        return $service->$value;
    return '';
    }

}
