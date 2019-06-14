<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contacts;
use App\About;
use App\Data;
use DB;

class TeamController extends Controller {

    public function getIndex() {

        $contact = new Contacts;
    	$data = new Data;
    	$abouts = new About;
    	$about = DB::table('about')
                  ->select('about.*')
                  ->where('id','=', 1)
                  ->get();
        $doctors = DB::table('doctors')
            ->select('doctors.*')
            ->get();

        $stories = DB::table('stories')
            ->select('stories.*')
            ->get();


        return view('site.pages.team',compact('contact','abouts','data','about','doctors','stories'));
    }

}
