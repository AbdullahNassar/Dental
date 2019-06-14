<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class AboutController extends Controller {

    public function getAbout()
    {
        $abouts = DB::table('about')
            ->select('about.*')
            ->where('id','=', 1)
            ->get();
        return view('admin.pages.about', compact('abouts'));
    }
    
    public function updateAbout(Request $request)
    {
        $_header = $request->input('_header');
        $_header_en = $request->input('_header_en');
        $p1 = $request->input('p1');
        $p1_en = $request->input('p1_en');
        $p2 = $request->input('p2');
        $p2_en = $request->input('p2_en');
        $p3 = $request->input('p3');
        $p3_en = $request->input('p3_en');
        $data = array('_header' => $_header ,
         '_header_en' => $_header_en ,
         'p1' => $p1 ,'p1_en' => $p1_en ,
         'p2' => $p2 ,'p2_en' => $p2_en ,
         'p3' => $p3 ,'p3_en' => $p3_en );
        DB::table('about')
            ->where('id', 1)
            ->update($data);

        return view('admin.pages.home');
    }

}
